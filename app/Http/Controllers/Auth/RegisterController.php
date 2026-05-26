<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegisterForm()
    {
        $subscriptions = Subscription::orderBy('price')->get();

        return view('auth.register', compact('subscriptions'));
    }

    /**
     * Handle a registration request.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'subscription_id' => ['required', 'exists:subscriptions,id'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));

        // create tenant owned by this user; use user's name for tenant name
        $tenantData = collect($validated)->except(['password'])->toArray();
        $tenantData['name'] = $tenantData['name'] ?? $user->name;

        // registration password 
        $tenantData['registration_password'] = $validated['password'];

        $tenant = $user->tenants()->create($tenantData);

        // random string of 6 characters for domain subdomain
        $domainName = str()->random(6);

        $tenant->domains()->create([
            'domain' => $domainName . '.' . config('app.domain'),
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

        Auth::login($user);

        return redirect('/dashboard');
    }
}
