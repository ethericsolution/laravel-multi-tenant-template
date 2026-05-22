<x-app-layout>
    <div class="max-w-7xl space-y-6 p-4">
        <h1 class="text-base-content text-3xl font-semibold">Profile</h1>


        @if (session('status'))
            <div class="alert alert-success" role="alert">
                @if (session('status') === 'two-factor-authentication-enabled')
                    Two Factor Authentication Enabled!!!
                @elseif(session('status') === 'two-factor-authentication-disabled')
                    Two Factor Authentication Disabled!!!
                @elseif(session('status') === 'password-updated')
                    Password Updated Successfully!!!
                @else
                    Profile Updated Successfully!!!
                @endif
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')
            <div class="card">

                <div class="card-body">
                    <div class="text-base-content text-lg font-medium">Profile</div>

                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- Name --}}
                        <x-form.input label="Name" name="name" :value="Auth::user()->name" required />

                        {{-- Email --}}
                        <x-form.input label="Email Address" name="email" type="email" :value="Auth::user()->email" required />

                        <div class="col-span-full">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form method="POST" action="{{ route('profile.password.update') }}">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <h5 class="text-base-content text-lg font-medium">Change Password</h5>

                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- Current Password --}}
                        <x-form.password label="Current Password" name="current_password" required />

                        {{-- New Password --}}
                        <x-form.password label="New Password" name="password" required />

                        {{-- Confirm New Password --}}
                        <x-form.password label="Confirm New Password" name="password_confirmation" required />

                        <div class="col-span-full">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
