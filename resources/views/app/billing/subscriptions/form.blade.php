<x-tenant-app-layout>
    @php
        $breadcrumbLinks = [
            ['url' => route('app.dashboard'), 'text' => __('Dashboard')],
            ['url' => route('app.billing.subscriptions.index'), 'text' => __('Subscriptions')],
        ];

        $title = $subscription->id ? __('Edit') . " {$subscription->name}" : __('Create Subscription');
    @endphp

    <x-slot name="header">
        <div class="p-4 space-y-6">
            <x-common.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('app.billing.subscriptions.index')" />
        </div>
    </x-slot>

    <form
        action="{{ $subscription->id ? route('app.billing.subscriptions.update', $subscription) : route('app.billing.subscriptions.store') }}"
        method="POST">
        @csrf
        @if (isset($subscription->id))
            @method('PUT')
        @endif

        <x-form.input label="Name" name="name" :value="$subscription->name" required />
        <x-form.input label="Plan" name="plan" :value="$subscription->plan" />
        <x-form.input label="Price" name="price" :value="$subscription->price ?? 0" required type="number" step="0.01" />
        <x-form.input label="Status" name="status" :value="$subscription->status ?? 'active'" />

        <div class="mt-4">
            <button class="btn btn-primary">{{ $subscription->id ? __('Update') : __('Create') }}</button>
            <a href="{{ route('app.billing.subscriptions.index') }}" class="btn btn-soft">{{ __('Cancel') }}</a>
        </div>
    </form>

</x-tenant-app-layout>
