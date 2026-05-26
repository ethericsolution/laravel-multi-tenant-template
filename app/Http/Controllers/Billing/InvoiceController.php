<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('subscription')->orderBy('created_at', 'desc')->paginate();

        return view('billing.invoices.index', compact('invoices'));
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('subscription', 'payments');

        return view('billing.invoices.show', compact('invoice'));
    }

    public function download(Invoice $invoice)
    {
        $invoice->load('subscription', 'payments');

        $pdf = Pdf::loadView('billing.invoices.pdf', compact('invoice'))
            ->setPaper('a4', 'portrait');

        return $pdf->download($invoice->number . '.pdf');
    }
}
