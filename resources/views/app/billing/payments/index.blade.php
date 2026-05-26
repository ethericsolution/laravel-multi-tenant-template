<x-tenant-app-layout>
    @php
        $breadcrumbLinks = [
            ['url' => route('app.dashboard'), 'text' => __('Dashboard')],
            ['url' => route('app.billing.payments.index'), 'text' => __('Payments')],
            ['text' => __('app.list')],
        ];
    @endphp

    <x-slot name="header">
        <div class="p-4 space-y-6">
            <x-common.breadcrumb :links=$breadcrumbLinks :title="__('Payments')" :addNewAction="route('app.billing.payments.create')" />
        </div>
    </x-slot>

    <table class="table border-y border-base-content/20">
        <thead>
            <tr>
                <th class="ps-4">Invoice</th>
                <th>Amount</th>
                <th>Method</th>
                <th>Status</th>
                <th class="text-end pe-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
                <tr>
                    <td class="ps-4 font-semibold">{{ optional($payment->invoice)->number }}</td>
                    <td>{{ number_format($payment->amount, 2) }}</td>
                    <td>{{ $payment->method }}</td>
                    <td>{{ $payment->status }}</td>
                    <td class="text-end pe-4">
                        <a href="{{ route('app.billing.payments.edit', $payment) }}"
                            class="btn btn-xs btn-outline btn-primary">{{ __('Edit') }}</a>
                        <button type="button" class="btn btn-xs btn-outline btn-error"
                            onclick="document.getElementById('deleteResourceForm').action = '{{ route('app.billing.payments.destroy', $payment) }}';">{{ __('Delete') }}</button>
                    </td>
                </tr>
            @empty
                <x-common.no-record columns=5 />
            @endforelse
        </tbody>
    </table>

    {!! $payments->links() !!}

</x-tenant-app-layout>
