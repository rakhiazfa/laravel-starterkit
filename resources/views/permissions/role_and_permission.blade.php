<x-cube.auth.layout title="Roles and Permissions">

    @if (session('success'))
        <x-cube.alert type="success" message="{{ session('success') }}"></x-cube.alert>
    @endif

    <section>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-7">
            @foreach ($roles as $role)
                <x-cube.card title="{{ $role->name }}" class="relative" headerClass="border-b" :actions="[
                    [
                        'type' => 'button',
                        'text' => 'Show Permission',
                        'class' => 'modal-trigger',
                        'target' => '#rolePermissionsModal-' . $loop->iteration,
                    ],
                ]">

                    <div class="flex justify-around gap-3">
                        <button class="flex flex-col items-center gap-2 text-gray-400 modal-trigger"
                            data-target="#editRoleModal-{{ $loop->iteration }}" aria-label="Edit Role">
                            <i class="uil uil-pen"></i>
                            <span class="text-[0.5rem] sm:text-[0.65rem] font-semibold">Edit</span>
                        </button>
                        <button class="flex flex-col items-center gap-2 text-gray-400 modal-trigger"
                            data-target="#givePermissionModal-{{ $loop->iteration }}" aria-label="Give Permissions">
                            <i class="uil uil-arrow-circle-up"></i>
                            <span class="text-[0.5rem] sm:text-[0.65rem] font-semibold">Give Permissions</span>
                        </button>
                        <button class="flex flex-col items-center gap-2 text-gray-400 modal-trigger"
                            data-target="#revokePermissionModal-{{ $loop->iteration }}" aria-label="Revoke Permissions">
                            <i class="uil uil-arrow-circle-down"></i>
                            <span class="text-[0.5rem] sm:text-[0.65rem] font-semibold">Revoke Permissions</span>
                        </button>
                        <button class="flex flex-col items-center gap-2 text-gray-400 modal-trigger"
                            data-target="#deleteRoleModal-{{ $loop->iteration }}" aria-label="Delete Role">
                            <i class="uil uil-trash-alt"></i>
                            <span class="text-[0.5rem] sm:text-[0.65rem] font-semibold">Delete</span>
                        </button>
                    </div>

                </x-cube.card>

                <div class="modal" id="editRoleModal-{{ $loop->iteration }}">
                    <div class="modal-content top">
                        <div class="header">
                            <h4>Edit Role</h4>
                        </div>
                        <div class="body">
                            <form action="{{ route('roles.update', ['role' => $role]) }}" method="POST"
                                id="editRoleForm-{{ $loop->iteration }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label class="label">Role</label>
                                    <input type="text" class="field" name="role_name"
                                        value="{{ $role->name ?? '' }}">
                                    @error('role_name')
                                        <p class="invalid-field">{{ $message }}</p>
                                    @enderror
                                </div>
                            </form>
                        </div>
                        <div class="footer flex justify-end gap-x-5">
                            <button type="button" class="btn btn-sm btn-info modal-cancel-trigger"
                                aria-label="Cancel Modal">Cancel</button>
                            <button type="button" class="btn btn-sm btn-primary form-trigger"
                                data-target="#editRoleForm-{{ $loop->iteration }}" aria-label="Edit Role">
                                Save
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal" id="givePermissionModal-{{ $loop->iteration }}">
                    <div class="modal-content top">
                        <div class="header">
                            <h4>Give Permission</h4>
                        </div>
                        <div class="body">
                            <form action="{{ route('roles.give_permission', ['role' => $role]) }}" method="POST"
                                id="givePermissionForm-{{ $loop->iteration }}">
                                @csrf
                                <div class="form-group">
                                    <label class="label">Permission</label>
                                    <select class="field select2" name="permission_ids[]" multiple="multiple">
                                        @foreach ($permissionOptions as $permission)
                                            <option value="{{ $permission->id }}"
                                                {{ $role->permissions->contains($permission->id) ? 'disabled' : '' }}>
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
                                data-target="#givePermissionForm-{{ $loop->iteration }}" aria-label="Give Permissions">
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
                            <form action="{{ route('roles.revoke_permission', ['role' => $role]) }}" method="POST"
                                id="revokePermissionForm-{{ $loop->iteration }}">
                                @csrf
                                <div class="form-group">
                                    <label class="label">Permission</label>
                                    <select class="field select2" name="permission_ids[]" multiple="multiple">
                                        @foreach ($permissionOptions as $permission)
                                            <option value="{{ $permission->id }}"
                                                {{ !$role->permissions->contains($permission->id) ? 'disabled' : '' }}>
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

                <div class="modal" id="deleteRoleModal-{{ $loop->iteration }}">
                    <div class="modal-content top">
                        <div class="header">
                            <h4>Are you absolutely sure?</h4>
                        </div>
                        <form action="{{ route('roles.destroy', ['role' => $role]) }}" method="POST"
                            id="deleteRoleForm-{{ $loop->iteration }}">
                            @csrf
                            @method('DELETE')
                        </form>
                        <div class="footer flex justify-end gap-x-5">
                            <button type="button" class="btn btn-sm btn-info modal-cancel-trigger"
                                aria-label="Cancel Modal">Cancel</button>
                            <button type="button" class="btn btn-sm btn-border btn-danger form-trigger"
                                data-target="#deleteRoleForm-{{ $loop->iteration }}" aria-label="Delete Role">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal" id="rolePermissionsModal-{{ $loop->iteration }}">
                    <div class="modal-content top">
                        <div class="header">
                            <h4>Role Permissions</h4>
                        </div>
                        <div class="body">
                            <div class="flex flex-wrap justify-center gap-2">
                                @foreach ($role->permissions ?? [] as $permission)
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
            @endforeach
        </div>

    </section>

    <section>

        <x-cube.card title="Create a New Role" class="h-max">

            <form class="grid gap-7" action="{{ route('roles.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="label">Role Name</label>
                    <input type="text" class="field" name="role_name" placeholder="Enter the role name . . .">
                    @error('role_name')
                        <p class="invalid-field">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary" aria-label="Create a new Role">Create</button>
                </div>
            </form>

        </x-cube.card>

    </section>

    <section>

        <x-cube.card title="Permissions" class="w-full">

            <div class="table-responsive">
                <table class="table table-bordered-b table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Guard</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>
                                    {{ ($permissions->currentPage() - 1) * $permissions->perPage() + $loop->iteration }}
                                </td>
                                <th>{{ $permission->name ?? '' }}</th>
                                <th>{{ $permission->guard_name ?? '' }}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                {{ $permissions->links('pagination.tailwind') }}
            </div>

        </x-cube.card>

    </section>

</x-cube.auth.layout>
