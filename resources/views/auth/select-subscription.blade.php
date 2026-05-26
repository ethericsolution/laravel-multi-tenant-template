<x-app-layout>
    <x-slot name="header">
        <div class="p-4 space-y-2">
            <h1 class="text-2xl font-semibold">Choose your subscription</h1>
            <p class="text-sm text-base-content/70">Select a package to activate your account.</p>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto p-4 space-y-6">
        <form class="mb-4 space-y-4" method="POST" action="{{ route('subscription.store') }}">
            @csrf

            <div class="space-y-4">
                @foreach ($subscriptions as $subscription)
                    <label class="block rounded-lg border border-base-content/10 p-4 cursor-pointer">
                        <div class="flex items-start gap-3">
                            <input type="radio" name="subscription_id" value="{{ $subscription->id }}"
                                class="radio radio-primary mt-1"
                                {{ old('subscription_id') == $subscription->id ? 'checked' : '' }}>
                            <div>
                                <div class="font-semibold">{{ $subscription->name }}</div>
                                <div class="text-sm text-base-content/70 mt-1">
                                    {{ $subscription->plan ? ucfirst($subscription->plan) . ' • ' : '' }}
                                    {{ '$' . number_format($subscription->price, 2) }}
                                </div>
                            </div>
                        </div>
                    </label>
                @endforeach
            </div>

            @error('subscription_id')
                <span class="helper-text text-error">{{ $message }}</span>
            @enderror

            <button class="btn btn-lg btn-primary btn-gradient btn-block">{{ __('Continue') }}</button>
        </form>
    </div>
</x-app-layout>
