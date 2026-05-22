<x-tenant-guest-layout>
    <x-slot name="heading">Sign in to {{ config('app.name') }}</x-slot>

    <form method="POST" action="{{ route('app.login.store') }}" class="mb-4 space-y-4">
        @csrf

        {{-- Email --}}
        <x-form.input label="Email Address" name="email" type="email" required autofocus />

        {{-- Password --}}
        <x-form.password label="Password" name="password" required />

        <div class="flex items-center justify-between gap-y-2">
            <x-form.checkbox name="remember" id="rememberMe" label="Remember Me" :checked="request()->cookie('login_remember', true)" />

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="link link-animated link-primary font-normal">Forgot
                    Your Password?</a>
            @endif
        </div>

        <button class="btn btn-lg btn-primary btn-gradient btn-block">Sign in to
            {{ config('app.name') }}</button>
    </form>

    @if (Route::has('register'))
        <p class="text-base-content/80 mb-4 text-center">
            Don't have an account? <a class="link link-animated link-primary font-normal"
                href="{{ route('register') }}">Register</a>
        </p>
    @endif
</x-tenant-guest-layout>
