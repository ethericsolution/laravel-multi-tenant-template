<?php

namespace App\Http\Controllers\App\Billing;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Subscription;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('subscription')->orderBy('created_at', 'desc')->paginate();

        return view('app.billing.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $invoice = new Invoice();
        $subscriptions = Subscription::orderBy('name')->get();

        return view('app.billing.invoices.form', compact('invoice', 'subscriptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subscription_id' => ['nullable', 'exists:subscriptions,id'],
            'amount' => ['required', 'numeric'],
            'due_date' => ['nullable', 'date'],
            'status' => ['nullable', 'string'],
        ]);

        $validated['number'] = 'INV-' . time();

        Invoice::create($validated);

        return to_route('app.billing.invoices.index')
            ->with('success', 'Invoice created successfully.');
    }

    public function edit(Invoice $invoice)
    {
        $subscriptions = Subscription::orderBy('name')->get();

        return view('app.billing.invoices.form', compact('invoice', 'subscriptions'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'subscription_id' => ['nullable', 'exists:subscriptions,id'],
            'amount' => ['required', 'numeric'],
            'due_date' => ['nullable', 'date'],
            'status' => ['nullable', 'string'],
        ]);

        $invoice->update($validated);

        return to_route('app.billing.invoices.index')
            ->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return back()->with('success', 'Invoice deleted successfully.');
    }
}
