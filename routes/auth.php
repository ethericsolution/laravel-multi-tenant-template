<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{
    LoginController,
    RegisterController,
    ForgotPasswordController,
    ResetPasswordController,
};

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        // Authentication Routes
        Route::middleware('guest')->group(function () {
            // Login
            Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
            Route::post('/login', [LoginController::class, 'login'])->name('login.store');

            // Registration
            Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
            Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

            // Forgot Password
            Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
            Route::post('/forgot-password', [ForgotPasswordController::class, 'sendPasswordResetLink'])->name('password.email');

            // Reset Password
            Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
            Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
        });

        // Logout (requires auth)
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });
}
