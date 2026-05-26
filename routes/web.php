<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Billing\InvoiceController;
use App\Http\Controllers\Billing\PaymentController;
use App\Http\Controllers\SubscriptionSelectionController;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {

        Route::get('/', function () {
            return redirect('/dashboard');
        });

        Route::middleware('auth')->group(function () {
            Route::get('/subscription/select', [SubscriptionSelectionController::class, 'show'])->name('subscription.select');
            Route::post('/subscription/select', [SubscriptionSelectionController::class, 'store'])->name('subscription.store');
        });

        Route::middleware(['auth', 'verified'])->group(function () {

            Route::view('/dashboard', 'dashboard')->name('dashboard');

            // Profile update routes
            Route::view('/profile/edit', 'profile')->name('profile.edit');
            Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
            Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

            // Billing resources for tenants (manual creation for tenants)
            Route::resource('/billing/invoices', InvoiceController::class)->names('billing.invoices')->only(['index', 'show']);
            Route::get('/billing/invoices/{invoice}/download', [InvoiceController::class, 'download'])->name('billing.invoices.pdf');

            // Management area for central/main app: billing resources
            Route::prefix('/manage')->group(function () {});
        });
    });
}


require_once __DIR__ . '/auth.php';
