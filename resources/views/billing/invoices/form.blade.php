<x-app-layout>
    @php
        $breadcrumbLinks = [
            ['url' => route('dashboard'), 'text' => __('Dashboard')],
            ['url' => route('billing.invoices.index'), 'text' => __('Invoices')],
        ];

        $title = $invoice->id ? __('Edit') . " {$invoice->number}" : __('Create Invoice');
    @endphp

    <x-slot name="header">
        <div class="p-4 space-y-6">
            <x-common.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('billing.invoices.index')" />
        </div>
    </x-slot>

    <form action="{{ $invoice->id ? route('billing.invoices.update', $invoice) : route('billing.invoices.store') }}"
        method="POST">
        @csrf
        @if (isset($invoice->id))
            @method('PUT')
        @endif

        <x-form.select label="Subscription" name="subscription_id" :options="$subscriptions->pluck('name', 'id')" :value="$invoice->subscription_id" />
        <x-form.input label="Amount" name="amount" :value="$invoice->amount ?? 0" required type="number" step="0.01" />
        <x-form.input label="Due Date" name="due_date" :value="$invoice->due_date" type="date" />
        <x-form.input label="Status" name="status" :value="$invoice->status ?? 'draft'" />

        <div class="mt-4">
            <button class="btn btn-primary">{{ $invoice->id ? __('Update') : __('Create') }}</button>
            <a href="{{ route('billing.invoices.index') }}" class="btn btn-soft">{{ __('Cancel') }}</a>
        </div>
    </form>

</x-app-layout>
