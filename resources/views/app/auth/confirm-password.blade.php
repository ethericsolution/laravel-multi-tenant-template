<x-guest-layout>
    <x-slot name="heading">{{ __('Confirm Password') }}</x-slot>
    <x-slot
        name="subheading">{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</x-slot>

    <div class="space-y-4">
        @session('status')
            <p class="text-success">
                {{ $value }}
            </p>
        @endsession
        <form method="POST" action="{{ route('password.confirm') }}" class="mb-4 space-y-4">
            @csrf
            {{-- Password --}}
            <x-form.password label="Password" name="password" required />

            <button class="btn btn-lg btn-primary btn-gradient btn-block">Confirm</button>
        </form>
    </div>
</x-guest-layout>
