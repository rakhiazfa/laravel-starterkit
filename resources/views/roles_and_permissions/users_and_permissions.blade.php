<x-cube.auth.layout title="Users and Permissions">

    @if (session('success'))
        <x-cube.alert type="success" message="{{ session('success') }}"></x-cube.alert>
    @endif

    <section>

        <x-cube.card title="Filter" class="mb-7">

            <form class="flex flex-col sm:flex-row items-center gap-5">

                <div class="form-group">
                    <input type="text" class="field field-rounded" name="q" placeholder="Search . . ."
                        value="{{ request()->get('q') }}">
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit" class="btn btn-xs btn-primary">
                        <i class="uil uil-search"></i>
                        <span>Search</span>
                    </button>

                    <button type="button" class="btn btn-xs btn-primary clear-parameters">
                        <i class="uil uil-sync"></i>
                        <span>Refresh</span>
                    </button>
                </div>

            </form>

        </x-cube.card>

        <x-cube.card title="Users and Permissions">

            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                                <th>
                                    <div class="flex items-center gap-5">
                                        <img class="w-[35px] h-[35px] rounded-full"
                                            src="{{ $user->avatar ? url('storage/' . $user->avatar) : $defaultAvatarImage }}"
                                            alt="Avatar">
                                        <span class="font-medium">{{ $user->name ?? '-' }}</span>
                                    </div>
                                </th>
                                <td>{{ $user->email ?? '' }}</td>
                                <td>
                                    <div class="table-actions">
                                        <button type="button"
                                            class="btn btn-xs btn-info flex items-center gap-1 modal-trigger"
                                            data-target="#userPermissionsModal-{{ $loop->iteration }}">
                                            <span>Show Permissions</span>
                                        </button>

                                        <button type="button"
                                            class="btn btn-xs btn-info flex items-center gap-1 modal-trigger"
                                            data-target="#givePermissionModal-{{ $loop->iteration }}">
                                            <span>Give Permissions</span>
                                        </button>

                                        <button type="button"
                                            class="btn btn-xs btn-info flex items-center gap-1 modal-trigger"
                                            data-target="#revokePermissionModal-{{ $loop->iteration }}">
                                            <span>Revoke Permissions</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal" id="userPermissionsModal-{{ $loop->iteration }}">
                                <div class="modal-content top">
                                    <div class="header">
                                        <h4>User Permissions</h4>
                                    </div>
                                    <div class="body">
                                        <div class="flex flex-wrap justify-center gap-2">
                                            @foreach ($user->permissions ?? [] as $permission)
                                                <div
                                                    class="bg-blue-400 text-xs text-white font-medium rounded-full shadow-xxs px-3 py-2">
                                                    {{ $permission->name ?? '' }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="footer flex justify-end gap-x-5">
                                        <button type="button" class="btn btn-sm btn-info modal-cancel-trigger"
                                            aria-label="Cancel Modal">Cancel</button>
                                    </div>
                                </div>
                            </div>

                            <div class="modal" id="givePermissionModal-{{ $loop->iteration }}">
                                <div class="modal-content top">
                                    <div class="header">
                                        <h4>Give Permission</h4>
                                    </div>
                                    <div class="body">
                                        <form action="{{ route('users.give_permissions', ['user' => $user]) }}"
                                            method="POST" id="givePermissionForm-{{ $loop->iteration }}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="label">Permission</label>
                                                <select class="field select2" name="permission_ids[]"
                                                    multiple="multiple">
                                                    @foreach ($permissions as $permission)
                                                        <option value="{{ $permission->id }}"
                                                            {{ $user->permissions->contains($permission->id) ? 'disabled' : '' }}>
                                                            {{ $permission->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('permission_ids')
                                                    <p class="invalid-field">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>
                                    <div class="footer flex justify-end gap-x-5">
                                        <button type="button" class="btn btn-sm btn-info modal-cancel-trigger"
                                            aria-label="Cancel Modal">Cancel</button>
                                        <button type="button" class="btn btn-sm btn-primary form-trigger"
                                            data-target="#givePermissionForm-{{ $loop->iteration }}"
                                            aria-label="Give Permissions">
                                            Give
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="modal" id="revokePermissionModal-{{ $loop->iteration }}">
                                <div class="modal-content top">
                                    <div class="header">
                                        <h4>Revoke Permission</h4>
                                    </div>
                                    <div class="body">
                                        <form action="{{ route('users.revoke_permissions', ['user' => $user]) }}"
                                            method="POST" id="revokePermissionForm-{{ $loop->iteration }}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="label">Permission</label>
                                                <select class="field select2" name="permission_ids[]"
                                                    multiple="multiple">
                                                    @foreach ($permissions as $permission)
                                                        <option value="{{ $permission->id }}"
                                                            {{ !$user->permissions->contains($permission->id) ? 'disabled' : '' }}>
                                                            {{ $permission->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('permission_ids')
                                                    <p class="invalid-field">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>
                                    <div class="footer flex justify-end gap-x-5">
                                        <button type="button" class="btn btn-sm btn-info modal-cancel-trigger"
                                            aria-label="Cancel Modal">Cancel</button>
                                        <button type="button" class="btn btn-sm btn-border btn-danger form-trigger"
                                            data-target="#revokePermissionForm-{{ $loop->iteration }}"
                                            aria-label="Revoke Permissions">
                                            Revoke
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                {{ $users->links('pagination.tailwind') }}
            </div>

        </x-cube.card>

    </section>

</x-cube.auth.layout>
