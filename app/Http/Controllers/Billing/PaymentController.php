<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('invoice')->orderBy('created_at', 'desc')->paginate();

        return view('billing.payments.index', compact('payments'));
    }

    public function create()
    {
        $payment = new Payment();
        $invoices = Invoice::orderBy('number')->get();

        return view('billing.payments.form', compact('payment', 'invoices'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_id' => ['required', 'exists:invoices,id'],
            'amount' => ['required', 'numeric'],
            'method' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
            'paid_at' => ['nullable', 'date'],
        ]);

        Payment::create($validated);

        return to_route('billing.payments.index')
            ->with('success', 'Payment recorded successfully.');
    }

    public function edit(Payment $payment)
    {
        $invoices = Invoice::orderBy('number')->get();

        return view('billing.payments.form', compact('payment', 'invoices'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'invoice_id' => ['required', 'exists:invoices,id'],
            'amount' => ['required', 'numeric'],
            'method' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
            'paid_at' => ['nullable', 'date'],
        ]);

        $payment->update($validated);

        return to_route('billing.payments.index')
            ->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return back()->with('success', 'Payment deleted successfully.');
    }
}
