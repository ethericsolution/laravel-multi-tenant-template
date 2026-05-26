<x-tenant-app-layout>
    @php
        $breadcrumbLinks = [
            ['url' => route('app.dashboard'), 'text' => __('Dashboard')],
            ['url' => route('app.billing.payments.index'), 'text' => __('Payments')],
        ];

        $title = $payment->id ? __('Edit') . " #{$payment->id}" : __('Record Payment');
    @endphp

    <x-slot name="header">
        <div class="p-4 space-y-6">
            <x-common.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('app.billing.payments.index')" />
        </div>
    </x-slot>

    <form
        action="{{ $payment->id ? route('app.billing.payments.update', $payment) : route('app.billing.payments.store') }}"
        method="POST">
        @csrf
        @if (isset($payment->id))
            @method('PUT')
        @endif

        <x-form.select label="Invoice" name="invoice_id" :options="$invoices->pluck('number', 'id')" :value="$payment->invoice_id" required />
        <x-form.input label="Amount" name="amount" :value="$payment->amount ?? 0" required type="number" step="0.01" />
        <x-form.input label="Method" name="method" :value="$payment->method" />
        <x-form.input label="Paid At" name="paid_at" :value="$payment->paid_at" type="date" />
        <x-form.input label="Status" name="status" :value="$payment->status ?? 'completed'" />

        <div class="mt-4">
            <button class="btn btn-primary">{{ $payment->id ? __('Update') : __('Create') }}</button>
            <a href="{{ route('app.billing.payments.index') }}" class="btn btn-soft">{{ __('Cancel') }}</a>
        </div>
    </form>

</x-tenant-app-layout>
