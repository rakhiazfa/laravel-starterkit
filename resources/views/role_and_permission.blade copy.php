<x-cube.auth.layout title="Roles and Permissions">

    @if (session('success'))
        <x-cube.alert type="success" message="{{ session('success') }}"></x-cube.alert>
    @endif

    <section>

        <x-cube.card title="Roles">

            <div class="grid gap-5">
                @foreach ($roles as $role)
                    <div>
                        <div class="flex flex-wrap justify-center items-center gap-3 bg-blue-50 rounded-md py-2 mb-5">
                            <h5 class="text-sm font-medium">{{ $role->name ?? '' }}</h5>

                            @if ($role->name !== 'super-admin')
                                -
                                <button class="text-sm font-normal text-blue-600 hover:underline modal-trigger"
                                    data-target="#editRoleModal-{{ $loop->iteration }}">Edit</button>
                                -
                                <button class="text-sm font-normal text-blue-600 hover:underline modal-trigger"
                                    data-target="#givePermissionModal-{{ $loop->iteration }}">Give Permission</button>
                                -
                                <button class="text-sm font-normal text-red-500 hover:underline modal-trigger"
                                    data-target="#revokePermissionModal-{{ $loop->iteration }}">Revoke
                                    Permission</button>
                                -
                                <button class="text-sm font-normal text-red-500 hover:underline modal-trigger"
                                    data-target="#deleteRoleModal-{{ $loop->iteration }}">
                                    Delete
                                </button>
                            @endif

                        </div>
                        <div class="flex flex-wrap justify-center items-center gap-3">
                            @foreach ($role->permissions ?? [] as $permission)
                                <div class="bg-blue-500 rounded-md px-5 py-2">
                                    <p class="text-[0.675rem] text-white text-center font-normal">
                                        {{ $permission->name ?? '' }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>

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
                                <button type="button" class="btn btn-sm btn-info modal-cancel-trigger">Cancel</button>
                                <button type="button" class="btn btn-sm btn-dark form-trigger"
                                    data-target="#editRoleForm-{{ $loop->iteration }}">
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
                                            @foreach ($permissions as $permission)
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
                                <button type="button" class="btn btn-sm btn-info modal-cancel-trigger">Cancel</button>
                                <button type="button" class="btn btn-sm btn-dark form-trigger"
                                    data-target="#givePermissionForm-{{ $loop->iteration }}">
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
                                            @foreach ($permissions as $permission)
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
                                <button type="button" class="btn btn-sm btn-info modal-cancel-trigger">Cancel</button>
                                <button type="button" class="btn btn-sm btn-border btn-danger form-trigger"
                                    data-target="#revokePermissionForm-{{ $loop->iteration }}">
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
                                <button type="button" class="btn btn-sm btn-info modal-cancel-trigger">Cancel</button>
                                <button type="button" class="btn btn-sm btn-border btn-danger form-trigger"
                                    data-target="#deleteRoleForm-{{ $loop->iteration }}">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </x-cube.card>

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
                    <button type="submit" class="btn btn-sm btn-dark">Create</button>
                </div>
            </form>

        </x-cube.card>

    </section>

    <section>

        <x-cube.card title="Permissions" class="w-full">

            <table class="table table-bordered table-sm">
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
            <div class="mt-5">
                {{ $permissions->links('pagination.tailwind') }}
            </div>

        </x-cube.card>

    </section>

</x-cube.auth.layout>
