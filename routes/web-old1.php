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

// =========================
// Admin Routes
// =========================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
});

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {
        Route::get('/complaints', [AdminComplaintController::class, 'index'])->name('complaints.index');
        Route::get('/complaints/export', [AdminComplaintController::class, 'export'])->name('complaints.export');

        Route::get('form-builder', [FormBuilderController::class, 'index'])->name('form-builder');
        Route::post('form-builder/save', [FormBuilderController::class, 'save'])->name('form-builder.save');

        Route::resource('fields', FormFieldController::class);

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('settings', [SettingController::class, 'index'])->name('settings');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

        Route::get('email-recipients', [EmailRecipientController::class, 'index'])->name('email-recipients');
        Route::post('email-recipients', [EmailRecipientController::class, 'store'])->name('email-recipients.store');
        Route::delete('email-recipients/{id}', [EmailRecipientController::class, 'destroy'])->name('email-recipients.destroy');
    });

Route::prefix('admin/settings')->middleware(['auth', 'admin'])->group(function () {
    // Route::get('/branding', [App\Http\Controllers\Admin\SettingController::class, 'branding'])->name('admin.settings.branding');
    // Route::post('/branding', [App\Http\Controllers\Admin\SettingController::class, 'updateBranding'])->name('admin.settings.branding.update');
    Route::get('/branding', [BrandingController::class, 'edit'])->name('branding');
    Route::post('/branding', [BrandingController::class, 'update'])->name('branding.update');
});
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/email-recipients', [EmailRecipientController::class, 'index'])->name('admin.email-recipients');
    Route::post('/email-recipients', [EmailRecipientController::class, 'store'])->name('admin.email-recipients.store');
    Route::delete('/email-recipients/{id}', [EmailRecipientController::class, 'destroy'])->name('admin.email-recipients.destroy');
});
// Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
//     Route::get('settings', [SettingController::class, 'index'])->name('admin.settings');
//     Route::post('settings', [SettingController::class, 'update'])->name('admin.settings.update');
// });

// =========================
// Public Routes
// =========================
Route::get('/', [FormController::class, 'index'])->name('complain.form');
Route::post('/submit', [FormController::class, 'submit'])->name('complain.submit');

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
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
