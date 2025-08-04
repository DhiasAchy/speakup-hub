<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Admin\FormBuilderController;
use App\Http\Controllers\Admin\FormFieldController;
use App\Http\Controllers\User\FormController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\EmailRecipientController;
use App\Http\Controllers\Admin\BrandingController;

// =========================
// Admin Routes
// =========================
Route::prefix('admin')
->middleware(['auth', 'admin'])
->name('admin.')
->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Complaints
    Route::get('/complaints', [AdminComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/complaints/export', [AdminComplaintController::class, 'export'])->name('complaints.export');

    // Form Builder
    Route::get('form-builder', [FormBuilderController::class, 'index'])->name('form-builder');
    Route::post('form-builder/save', [FormBuilderController::class, 'save'])->name('form-builder.save');

    // Settings - Branding
    Route::get('settings/branding', [BrandingController::class, 'edit'])->name('settings.branding');
    Route::post('settings/branding', [BrandingController::class, 'update'])->name('settings.branding.update');

    // Settings - Email Recipients
    Route::get('settings/email-recipients', [EmailRecipientController::class, 'index'])->name('settings.email-recipients');
    Route::post('settings/email-recipients', [EmailRecipientController::class, 'store'])->name('settings.email-recipients.store');
    Route::delete('settings/email-recipients/{id}', [EmailRecipientController::class, 'destroy'])->name('settings.email-recipients.destroy');
});

// =========================
// Guest Routes
// =========================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Optional Laravel Default Auth
// Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// =========================
// Public Routes
// =========================
Route::get('/', [FormController::class, 'index'])->name('complain.form');
Route::post('/submit', [FormController::class, 'submit'])->name('complain.submit');
