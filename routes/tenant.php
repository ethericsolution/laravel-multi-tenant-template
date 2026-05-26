<?php

declare(strict_types=1);

use App\Http\Controllers\App\UserController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->as('app.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('app.dashboard');

        dd(tenant(), tenant('name'));
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    })->name('home');

    Route::middleware('auth:tenant')->group(function () {
        Route::view('/dashboard', 'app.dashboard')->name('dashboard');


        Route::prefix('/manage')->group(function () {
            Route::resource('/users', UserController::class)->except('show');
            // Billing resources (manual creation for tenants)
        });
    });
});


require_once __DIR__ . '/tenant_auth.php';
