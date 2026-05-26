<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invoice->number }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #111827;
            margin: 0;
            padding: 0;
        }

        .page {
            padding: 24px;
        }

        .header,
        .footer {
            width: 100%;
        }

        .header {
            margin-bottom: 24px;
        }

        .invoice-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .meta-table,
        .line-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        .meta-table td,
        .line-table td,
        .line-table th {
            border: 1px solid #d1d5db;
            padding: 10px;
        }

        .line-table th {
            background: #f3f4f6;
            text-align: left;
        }

        .section-title {
            font-size: 14px;
            font-weight: 700;
            margin-top: 22px;
            margin-bottom: 8px;
        }

        .text-muted {
            color: #6b7280;
        }

        .text-right {
            text-align: right;
        }

        .small {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="header">
            <div class="invoice-title">{{ __('Invoice') }}</div>
            <div class="text-muted">{{ $invoice->number }}</div>
            <div class="text-muted">{{ __('Issued') }}: {{ $invoice->created_at->toFormattedDateString() }}</div>
        </div>

        <table class="meta-table">
            <tr>
                <td><strong>{{ __('Invoice Number') }}</strong></td>
                <td>{{ $invoice->number }}</td>
            </tr>
            <tr>
                <td><strong>{{ __('Status') }}</strong></td>
                <td>{{ $invoice->status }}</td>
            </tr>
            <tr>
                <td><strong>{{ __('Amount') }}</strong></td>
                <td>${{ number_format($invoice->amount, 2) }}</td>
            </tr>
            <tr>
                <td><strong>{{ __('Due Date') }}</strong></td>
                <td>{{ $invoice->due_date ? $invoice->due_date->toFormattedDateString() : __('No due date') }}</td>
            </tr>
        </table>

        <div class="section-title">{{ __('Subscription') }}</div>
        <table class="meta-table">
            <tr>
                <td><strong>{{ __('Name') }}</strong></td>
                <td>{{ optional($invoice->subscription)->name ?? __('No subscription selected') }}</td>
            </tr>
            <tr>
                <td><strong>{{ __('Price') }}</strong></td>
                <td>${{ number_format(optional($invoice->subscription)->price ?? 0, 2) }}</td>
            </tr>
            <tr>
                <td><strong>{{ __('Description') }}</strong></td>
                <td>{{ optional($invoice->subscription)->description ?? __('No subscription selected') }}</td>
            </tr>
        </table>

        <div class="section-title">{{ __('Payments') }}</div>
        <table class="line-table">
            <thead>
                <tr>
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('Amount') }}</th>
                    <th>{{ __('Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invoice->payments as $payment)
                    <tr>
                        <td>{{ $payment->created_at->toFormattedDateString() }}</td>
                        <td>${{ number_format($payment->amount, 2) }}</td>
                        <td>{{ $payment->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="small text-muted">{{ __('No payments recorded.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="section-title">{{ __('Total') }}</div>
        <table class="meta-table">
            <tr>
                <td><strong>{{ __('Invoice Total') }}</strong></td>
                <td class="text-right">${{ number_format($invoice->amount, 2) }}</td>
            </tr>
            <tr>
                <td><strong>{{ __('Payments Total') }}</strong></td>
                <td class="text-right">${{ number_format($invoice->payments->sum('amount'), 2) }}</td>
            </tr>
            <tr>
                <td><strong>{{ __('Balance Due') }}</strong></td>
                <td class="text-right">${{ number_format($invoice->amount - $invoice->payments->sum('amount'), 2) }}
                </td>
            </tr>
        </table>

        <div class="footer small text-muted" style="margin-top: 24px;">
            {{ __('Thank you for your business.') }}
        </div>
    </div>
</body>

</html>
