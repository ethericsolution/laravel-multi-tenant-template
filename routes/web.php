<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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
        });
    });
}


require_once __DIR__ . '/auth.php';
