<x-cube.auth.layout title="Profile">

    <section>

        <x-cube.card>

            <form action="" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-7">

                    <div class="form-group">
                        <label class="label">Name</label>
                        <input type="text" class="field" name="name" value="{{ $profile->name }}">
                        @error('name')
                            <p class="invalid-field">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="label">Email</label>
                        <input type="text" class="field" name="email" value="{{ $profile->email }}">
                        @error('email')
                            <p class="invalid-field">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="flex justify-end mt-10">
                    <button type="submit" class="btn btn-dark">Save</button>
                </div>
            </form>

        </x-cube.card>

    </section>

    <section>

        <x-cube.card title="Delete Account" titleClass="text-red-500">

            <p class="text-sm mb-5">Once you delete your account, there is no going back. Please be certain.</p>

            <button type="button" class="btn btn-border btn-danger modal-trigger" data-target="#deleteAccountModal">
                Delete
            </button>

        </x-cube.card>

    </section>

    <div class="modal" id="deleteAccountModal">
        <div class="modal-content top">
            <div class="header">
                <h4>Are you absolutely sure?</h4>
            </div>
            <div class="body">
                <form action="{{ route('profile.destroy') }}" method="POST" id="deleteAccountForm">
                    @csrf
                    @method('DELETE')

                    <div class="form-group">
                        <label class="label">Confirm Your Email</label>
                        <input type="text" class="field" name="email_confirmation"
                            placeholder="Please confirm your email . . .">
                        @error('email_confirmation')
                            <p class="invalid-field">{{ $message }}</p>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="footer flex justify-end gap-x-5">
                <button type="button" class="btn btn-sm btn-info modal-cancel-trigger">Cancel</button>
                <button type="button" class="btn btn-sm btn-border btn-danger form-trigger"
                    data-target="#deleteAccountForm">
                    Delete
                </button>
            </div>
        </div>
    </div>

</x-cube.auth.layout>
