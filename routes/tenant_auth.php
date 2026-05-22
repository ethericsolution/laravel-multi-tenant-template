<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App\Auth\{
    LoginController,
    RegisterController,
    ForgotPasswordController,
    ResetPasswordController,
};
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;


Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->as('app.')->group(function () {
    // Authentication Routes
    Route::middleware('guest:tenant')->group(function () {
        // Login
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.store');

        // // Registration
        // Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
        // Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

        // // Forgot Password
        // Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
        // Route::post('/forgot-password', [ForgotPasswordController::class, 'sendPasswordResetLink'])->name('password.email');

        // // Reset Password
        // Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
        // Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
    });

    // Logout (requires auth)
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
