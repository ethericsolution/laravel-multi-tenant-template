<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionSelectionController extends Controller
{
    public function show()
    {
        $subscriptions = Subscription::orderBy('price')->get();

        return view('auth.select-subscription', compact('subscriptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subscription_id' => ['required', 'exists:subscriptions,id'],
        ]);

        $subscription = Subscription::findOrFail($validated['subscription_id']);

        $invoice = Invoice::create([
            'subscription_id' => $subscription->id,
            'number' => 'INV-' . strtoupper(str()->random(8)),
            'amount' => $subscription->price,
            'status' => 'paid',
            'due_date' => now()->toDateString(),
        ]);

        Payment::create([
            'invoice_id' => $invoice->id,
            'amount' => $invoice->amount,
            'method' => 'manual',
            'status' => 'completed',
            'paid_at' => now(),
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Subscription purchased and payment recorded successfully.');
    }
}
