<x-app-layout>
    @php
        $breadcrumbLinks = [
            ['url' => route('dashboard'), 'text' => __('Dashboard')],
            ['url' => route('billing.invoices.index'), 'text' => __('Invoices')],
            ['text' => __('app.list')],
        ];
    @endphp

    <x-slot name="header">
        <div class="p-4 space-y-6">
            <x-common.breadcrumb :links=$breadcrumbLinks :title="__('Invoices')" />
        </div>
    </x-slot>

    <table class="table border-y border-base-content/20">
        <thead>
            <tr>
                <th class="ps-4">
                    <x-tables.sortable-header field="number" :current-sort="request('sort')">
                        {{ __('Invoice #') }}
                    </x-tables.sortable-header>
                </th>
                <th>
                    <x-tables.sortable-header field="subscription_id" :current-sort="request('sort')">
                        {{ __('Subscription') }}
                    </x-tables.sortable-header>
                </th>
                <th>
                    <x-tables.sortable-header field="amount" :current-sort="request('sort')">
                        {{ __('Amount') }}
                    </x-tables.sortable-header>
                </th>
                <th>
                    <x-tables.sortable-header field="status" :current-sort="request('sort')">
                        {{ __('Status') }}
                    </x-tables.sortable-header>
                </th>
                <th class="text-end pe-4 sr-only">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($invoices as $invoice)
                <tr>
                    <td class="ps-4 font-semibold">{{ $invoice->number }}</td>
                    <td>{{ optional($invoice->subscription)->name }}</td>
                    <td>{{ number_format($invoice->amount, 2) }}</td>
                    <td>{{ $invoice->status }}</td>
                    <td class="text-end pe-4">
                        <a href="{{ route('billing.invoices.show', $invoice) }}"
                            class="btn btn-xs btn-outline btn-secondary">{{ __('View') }}</a>
                        <a href="{{ route('billing.invoices.pdf', $invoice) }}"
                            class="btn btn-xs btn-outline btn-primary">{{ __('PDF') }}</a>
                    </td>
                </tr>
            @empty
                <x-common.no-record columns=5 />
            @endforelse
        </tbody>
    </table>

    {!! $invoices->links() !!}

</x-app-layout>
