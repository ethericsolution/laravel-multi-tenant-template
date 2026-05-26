<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::orderBy('created_at', 'desc')->paginate();

        return view('billing.subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        $subscription = new Subscription();

        return view('billing.subscriptions.form', compact('subscription'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:128'],
            'plan' => ['nullable', 'string', 'max:128'],
            'price' => ['required', 'numeric'],
            'status' => ['nullable', 'string'],
        ]);

        Subscription::create($validated);

        return to_route('billing.subscriptions.index')
            ->with('success', 'Subscription created successfully.');
    }

    public function edit(Subscription $subscription)
    {
        return view('billing.subscriptions.form', compact('subscription'));
    }

    public function update(Request $request, Subscription $subscription)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:128'],
            'plan' => ['nullable', 'string', 'max:128'],
            'price' => ['required', 'numeric'],
            'status' => ['nullable', 'string'],
        ]);

        $subscription->update($validated);

        return to_route('billing.subscriptions.index')
            ->with('success', 'Subscription updated successfully.');
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return back()->with('success', 'Subscription deleted successfully.');
    }
}
