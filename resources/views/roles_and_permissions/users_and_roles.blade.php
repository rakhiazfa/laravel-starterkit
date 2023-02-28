<x-cube.auth.layout title="Users and Roles">

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

        <x-cube.card title="Users and Roles">

            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User</th>
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
                                <td>
                                    <div class="table-actions">
                                        <button type="button" class="flex items-center gap-2 modal-trigger"
                                            data-target="#userRolesModal-{{ $loop->iteration }}">
                                            <i class="uil uil-eye"></i>
                                            <span>Show Roles</span>
                                        </button>

                                        <button type="button" class="flex items-center gap-2 modal-trigger"
                                            data-target="#assignRolesModal-{{ $loop->iteration }}">
                                            <i class="uil uil-arrow-circle-up"></i>
                                            <span>Assign Roles</span>
                                        </button>

                                        <button type="button" class="flex items-center gap-2 modal-trigger"
                                            data-target="#revokeRolesModal-{{ $loop->iteration }}">
                                            <i class="uil uil-arrow-circle-down"></i>
                                            <span>Revoke Roles</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal" id="userRolesModal-{{ $loop->iteration }}">
                                <div class="modal-content top">
                                    <div class="header">
                                        <h4>User Roles</h4>
                                    </div>
                                    <div class="body">
                                        <div class="flex flex-wrap justify-center gap-2">
                                            @foreach ($user->roles ?? [] as $role)
                                                <div
                                                    class="bg-blue-400 text-xs text-white font-medium rounded-full shadow-xxs px-3 py-2">
                                                    {{ $role->name ?? '' }}
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

                            <div class="modal" id="assignRolesModal-{{ $loop->iteration }}">
                                <div class="modal-content top">
                                    <div class="header">
                                        <h4>Assign Roles</h4>
                                    </div>
                                    <div class="body">
                                        <form action="{{ route('users.assign_roles', ['user' => $user]) }}"
                                            method="POST" id="assignRolesForm-{{ $loop->iteration }}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="label">Roles</label>
                                                <select class="field select2" name="role_ids[]" multiple="multiple">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}"
                                                            {{ $user->roles->contains($role->id) ? 'disabled' : '' }}>
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('role_ids')
                                                    <p class="invalid-field">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>
                                    <div class="footer flex justify-end gap-x-5">
                                        <button type="button" class="btn btn-sm btn-info modal-cancel-trigger"
                                            aria-label="Cancel Modal">Cancel</button>
                                        <button type="button" class="btn btn-sm btn-primary form-trigger"
                                            data-target="#assignRolesForm-{{ $loop->iteration }}"
                                            aria-label="Assign Roles">
                                            Assign
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="modal" id="revokeRolesModal-{{ $loop->iteration }}">
                                <div class="modal-content top">
                                    <div class="header">
                                        <h4>Revoke Roles</h4>
                                    </div>
                                    <div class="body">
                                        <form action="{{ route('users.revoke_roles', ['user' => $user]) }}"
                                            method="POST" id="revokeRolesForm-{{ $loop->iteration }}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="label">role</label>
                                                <select class="field select2" name="role_ids[]" multiple="multiple">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}"
                                                            {{ !$user->roles->contains($role->id) ? 'disabled' : '' }}>
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('role_ids')
                                                    <p class="invalid-field">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>
                                    <div class="footer flex justify-end gap-x-5">
                                        <button type="button" class="btn btn-sm btn-info modal-cancel-trigger"
                                            aria-label="Cancel Modal">Cancel</button>
                                        <button type="button" class="btn btn-sm btn-border btn-danger form-trigger"
                                            data-target="#revokeRolesForm-{{ $loop->iteration }}"
                                            aria-label="Revoke Roles">
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
