<x-guest-layout>
    <!-- /Logo -->
    <x-slot name="heading">Adventure starts here 🚀</x-slot>
    <x-slot name="subheading">Make your app management easy and fun!</x-slot>

    <form class="mb-4 space-y-4" method="POST" action="{{ route('register.store') }}">
        @csrf

        <!-- {{ __('app.name') }} -->
        <x-form.input label="Name" name="name" required autofocus autocomplete="name" />

        <!-- Email Address -->
        <x-form.input label="Email Address" name="email" type="email" required autocomplete="username" />

        <!-- Password -->
        <x-form.password label="Password" name="password" required />

        <x-form.password label="Confirm Password" name="password_confirmation" required />

        <button class="btn btn-lg btn-primary btn-gradient btn-block">{{ __('Register') }}</button>
    </form>

    <p class="text-base-content/80 mb-4 text-center">
        Already have an account?
        <a class="link link-animated link-primary font-normal" href="{{ route('login') }}">Sign in instead</a>
    </p>

</x-guest-layout>
