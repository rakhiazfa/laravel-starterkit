<x-cube.auth.layout title="Roles and Permissions">

    @if (session('success'))
        <div class="bg-emerald-500 rounded-lg px-5 py-[0.8rem] mb-5">
            <p class="text-sm text-white font-medium">{{ session('success') }}</p>
        </div>
    @endif

    <section>

        <x-cube.card title="Roles">

            @foreach ($roles as $role)
                <div>
                    <div class="flex flex-wrap justify-center items-center gap-3 bg-gray-100 border py-2">
                        <h5 class="text-sm font-medium">{{ $role->name ?? '' }}</h5>
                        -
                        <button class="text-xs text-blue-500 hover:underline modal-trigger"
                            data-target="#givePermissionModal-{{ $loop->iteration }}">Give Permission</button>
                        -
                        <button class="text-xs text-red-500 hover:underline modal-trigger"
                            data-target="#revokePermissionModal-{{ $loop->iteration }}">Revoke Permission</button>
                        -
                        <button class="text-xs text-red-500 hover:underline modal-trigger"
                            data-target="#deleteRoleModal-{{ $loop->iteration }}">
                            Delete
                        </button>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4">
                        @foreach ($role->permissions ?? [] as $permission)
                            <div class="border py-2">
                                <p class="text-sm text-center font-normal">{{ $permission->name ?? '' }}</p>
                            </div>
                        @endforeach
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
                                    <select class="field" name="permission_id">
                                        <option selected>- Select permission -</option>
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}"
                                                {{ $role->permissions->contains($permission->id) ? 'disabled' : '' }}>
                                                {{ $permission->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('permission_id')
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
                                    <select class="field" name="permission_id">
                                        <option selected>- Select permission -</option>
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}"
                                                {{ !$role->permissions->contains($permission->id) ? 'disabled' : '' }}>
                                                {{ $permission->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('permission_id')
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

        </x-cube.card>

    </section>

    <section>

        <x-cube.card title="Create a New Role" class="h-max">

            <form class="grid gap-7" action="{{ route('roles.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="label">Role Name</label>
                    <input type="text" class="field" name="name" placeholder="Enter the role name . . .">
                    @error('name')
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

        <div class="grid grid-cols-1 xl:grid-cols-[1fr,400px] gap-10">

            <x-cube.card title="Permissions">

                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <th>{{ $permission->name ?? '' }}</th>
                                <td>
                                    <div class="flex items-center gap-5">
                                        <a class="text-blue-500 font-normal" href="#">Edit</a>

                                        <button class="text-red-500 font-normal modal-trigger"
                                            data-target="#deletePermissionModal-{{ $loop->iteration }}">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal" id="deletePermissionModal-{{ $loop->iteration }}">
                                <div class="modal-content top">
                                    <div class="header">
                                        <h4>Are you absolutely sure?</h4>
                                    </div>
                                    <form action="{{ route('permissions.destroy', ['permission' => $permission]) }}"
                                        method="POST" id="deletePermissionForm-{{ $loop->iteration }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <div class="footer flex justify-end gap-x-5">
                                        <button type="button"
                                            class="btn btn-sm btn-info modal-cancel-trigger">Cancel</button>
                                        <button type="button" class="btn btn-sm btn-border btn-danger form-trigger"
                                            data-target="#deletePermissionForm-{{ $loop->iteration }}">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>

            </x-cube.card>

            <x-cube.card title="Create a New Permission" class="h-max">

                <form class="grid gap-7" action="{{ route('permissions.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="label">Permission Name</label>
                        <input type="text" class="field" name="name"
                            placeholder="Enter the permission name . . .">
                        @error('name')
                            <p class="invalid-field">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="btn btn-sm btn-dark">Create</button>
                    </div>
                </form>

            </x-cube.card>

        </div>

    </section>

</x-cube.auth.layout>