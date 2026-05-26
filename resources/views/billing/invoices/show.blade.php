<x-app-layout>
    @php
        $breadcrumbLinks = [
            ['url' => route('dashboard'), 'text' => __('Dashboard')],
            ['url' => route('billing.invoices.index'), 'text' => __('Invoices')],
            ['text' => __('Invoice Details')],
        ];
    @endphp

    <x-slot name="header">
        <div class="p-4 space-y-6">
            <x-common.breadcrumb :links=$breadcrumbLinks :title="__('Invoice Details')" :goBackAction="route('billing.invoices.index')" />
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="card p-6">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                <div>
                    <h1 class="text-2xl font-semibold">{{ $invoice->number }}</h1>
                    <p class="text-sm text-base-content/70">{{ __('Status') }}: {{ $invoice->status }}</p>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('billing.invoices.pdf', $invoice) }}" class="btn btn-primary btn-sm">
                        {{ __('Download PDF') }}
                    </a>
                    <a href="{{ route('billing.invoices.index') }}" class="btn btn-ghost btn-sm">
                        {{ __('Back') }}
                    </a>
                </div>
            </div>

            <div class="grid gap-4 mt-6 sm:grid-cols-2">
                <div class="space-y-2">
                    <span class="text-xs uppercase text-base-content/50">{{ __('Invoice date') }}</span>
                    <p>{{ $invoice->created_at->tz(config('app.timezone'))->toFormattedDateString() }}</p>
                </div>
                <div class="space-y-2">
                    <span class="text-xs uppercase text-base-content/50">{{ __('Due date') }}</span>
                    <p>{{ $invoice->due_date ? $invoice->due_date->toFormattedDateString() : __('No due date') }}</p>
                </div>
                <div class="space-y-2">
                    <span class="text-xs uppercase text-base-content/50">{{ __('Amount') }}</span>
                    <p>${{ number_format($invoice->amount, 2) }}</p>
                </div>
                <div class="space-y-2">
                    <span class="text-xs uppercase text-base-content/50">{{ __('Subscription') }}</span>
                    <p>{{ optional($invoice->subscription)->name ?? __('No subscription') }}</p>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-[2fr_1fr]">
            <section class="card p-6">
                <h2 class="text-lg font-semibold">{{ __('Subscription Details') }}</h2>
                <div class="mt-4 space-y-3">
                    <div>
                        <span class="text-sm text-base-content/60">{{ __('Name') }}</span>
                        <p>{{ optional($invoice->subscription)->name ?? __('No subscription selected') }}</p>
                    </div>
                    <div>
                        <span class="text-sm text-base-content/60">{{ __('Description') }}</span>
                        <p>{{ optional($invoice->subscription)->description ?? __('No subscription selected') }}</p>
                    </div>
                    <div>
                        <span class="text-sm text-base-content/60">{{ __('Price') }}</span>
                        <p>${{ number_format(optional($invoice->subscription)->price ?? 0, 2) }}</p>
                    </div>
                </div>
            </section>

            <section class="card p-6">
                <h2 class="text-lg font-semibold">{{ __('Invoice Summary') }}</h2>
                <dl class="mt-4 space-y-3 text-sm">
                    <div class="flex items-center justify-between">
                        <dt class="text-base-content/60">{{ __('Number') }}</dt>
                        <dd>{{ $invoice->number }}</dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="text-base-content/60">{{ __('Amount') }}</dt>
                        <dd>${{ number_format($invoice->amount, 2) }}</dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="text-base-content/60">{{ __('Status') }}</dt>
                        <dd>{{ $invoice->status }}</dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="text-base-content/60">{{ __('Total payments') }}</dt>
                        <dd>{{ number_format($invoice->payments->sum('amount'), 2) }}</dd>
                    </div>
                </dl>
            </section>
        </div>

        <section class="card p-6">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold">{{ __('Payments') }}</h2>
                <span class="text-sm text-base-content/60">{{ $invoice->payments->count() }}
                    {{ __('records') }}</span>
            </div>

            @if ($invoice->payments->isEmpty())
                <p class="mt-4 text-sm text-base-content/70">
                    {{ __('No payments have been recorded for this invoice yet.') }}</p>
            @else
                <div class="overflow-x-auto mt-4">
                    <table class="table w-full border border-base-content/10">
                        <thead>
                            <tr>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice->payments as $payment)
                                <tr>
                                    <td>{{ $payment->created_at->toFormattedDateString() }}</td>
                                    <td>${{ number_format($payment->amount, 2) }}</td>
                                    <td>{{ $payment->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </div>
</x-app-layout>
