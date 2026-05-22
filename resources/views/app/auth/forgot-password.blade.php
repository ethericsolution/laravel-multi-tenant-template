<x-guest-layout>
    <x-slot name="heading">{{ __('Forgot Password?') }}</x-slot>
    <x-slot
        name="subheading">{{ __("Enter your email and we'll send you instructions to reset your password") }}</x-slot>
    <div class="space-y-4">
        @session('status')
            <p class="text-success">{{ $value }}</p>
        @endsession
        <form method="POST" action="{{ route('password.email') }}" class="mb-4 space-y-4">
            @csrf

            {{-- Email --}}
            <x-form.input label="Email Address" name="email" type="email" required autofocus />

            <button class="btn btn-lg btn-primary btn-gradient btn-block">{{ __('Send Reset Link') }}</button>
        </form>

        <div class="group flex items-center justify-center gap-2">
            <span
                class="icon-[tabler--chevron-left] text-primary size-5 shrink-0 transition-transform group-hover:-translate-x-1 rtl:rotate-180"></span>
            <a href="{{ route('login') }}"
                class="link link-animated link-primary font-normal">{{ __('Back to login') }}</a>
        </div>
    </div>
</x-guest-layout>
