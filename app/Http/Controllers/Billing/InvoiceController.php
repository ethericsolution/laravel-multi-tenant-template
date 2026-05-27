<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = QueryBuilder::for(Invoice::class)
            ->whereHas('tenant', function ($query) {
                $query->whereIn('id', Auth::user()->tenants()->pluck('id'));
            })
            ->with('subscription')
            ->allowedFilters(
                // Global search across multiple fields
                AllowedFilter::callback('search', function ($query, $value) {
                    $query->search($value);
                }),
            )
            ->allowedSorts(
                'number',
                'subscription_id',
                'amount',
                'status',
                'created_at',
            )
            ->defaultSort('-created_at')
            ->paginate()
            ->appends(request()->query());

        return view('billing.invoices.index', compact('invoices'));
    }

    public function show(Invoice $invoice)
    {
        abort_unless(Auth::user()->tenants()->where('id', $invoice->tenant_id)->exists(), 403);


        $invoice->load('subscription', 'payments');

        return view('billing.invoices.show', compact('invoice'));
    }

    public function download(Invoice $invoice)
    {
        abort_unless(Auth::user()->tenants()->where('id', $invoice->tenant_id)->exists(), 403);

        $invoice->load('subscription', 'payments');

        $pdf = Pdf::loadView('billing.invoices.pdf', compact('invoice'))
            ->setPaper('a4', 'portrait');

        return $pdf->download($invoice->number . '.pdf');
    }
}
