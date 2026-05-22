<x-guest-layout>
    <x-slot name="heading">{{ __('Reset Password') }}</x-slot>
    <x-slot
        name="subheading">{{ __('Please enter your current password and choose a new password to update your account security.') }}</x-slot>


    <div class="space-y-4">
        <form method="POST" action="{{ route('password.update') }}" class="mb-4 space-y-4">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">


            {{-- Email --}}
            <x-form.input label="Email Address" name="email" type="email" :value="$request->email" readonly required />

            {{-- Password --}}
            <x-form.password label="Password" name="password" required />

            {{-- Confirm Password --}}
            <x-form.password label="Confirm Password" name="password_confirmation" required />

            <button class="btn btn-lg btn-primary btn-gradient btn-block">{{ __('Set new password') }}</button>
        </form>

        <div class="group flex items-center justify-center gap-2">
            <span
                class="icon-[tabler--chevron-left] text-primary size-5 shrink-0 transition-transform group-hover:-translate-x-1 rtl:rotate-180"></span>
            <a href="{{ route('login') }}"
                class="link link-animated link-primary font-normal">{{ __('Back to login') }}</a>
        </div>
    </div>
</x-guest-layout>
