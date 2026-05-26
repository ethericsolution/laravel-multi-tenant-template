<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
        return view('auth.register');
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

        Auth::login($user);

        return redirect()->route('subscription.select');
    }
}
