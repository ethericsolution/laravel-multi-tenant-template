<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Billing\SubscriptionController;
use App\Http\Controllers\Billing\InvoiceController;
use App\Http\Controllers\Billing\PaymentController;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {

        Route::get('/', function () {
            return redirect('/dashboard');
        });

        Route::middleware(['auth', 'verified'])->group(function () {

            Route::view('/dashboard', 'dashboard')->name('dashboard');

            Route::view('/profile/edit', 'profile')->name('profile.edit');

            // Profile update routes
            Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
            Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

            // Management area for central/main app: billing resources
            Route::prefix('/manage')->group(function () {
                Route::resource('/billing/subscriptions', SubscriptionController::class)->names('billing.subscriptions')->except('show');
                Route::resource('/billing/invoices', InvoiceController::class)->names('billing.invoices')->except('show');
                Route::resource('/billing/payments', PaymentController::class)->names('billing.payments')->except('show');
            });
        });
    });
}


require_once __DIR__ . '/auth.php';
