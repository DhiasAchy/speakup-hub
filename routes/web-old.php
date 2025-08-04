<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\Admin\FormBuilderController;
use App\Http\Controllers\User\FormController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/complaints', [ComplaintController::class, 'index'])->name('admin.complaints');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('fields', \App\Http\Controllers\Admin\FormFieldController::class);
});
Route::prefix('admin')->group(function () {
    Route::get('form-builder', [FormBuilderController::class, 'index'])->name('admin.form-builder');
    Route::post('form-builder/save', [FormBuilderController::class, 'save'])->name('admin.form-builder.save');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/complaints', [\App\Http\Controllers\Admin\ComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/complaints/export', [\App\Http\Controllers\Admin\ComplaintController::class, 'export'])->name('complaints.export');
});
// end admin routes

// public routes
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [ComplaintController::class, 'index']);
// Route::post('/submit', [ComplaintController::class, 'store'])->name('complaint.store');
Route::get('/', [FormController::class, 'index'])->name('complain.form');
Route::post('/submit', [FormController::class, 'store'])->name('complain.submit');

// Route::get('complain', [FormController::class, 'index'])->name('complain.form');
// Route::post('complain/submit', [FormController::class, 'submit'])->name('complain.submit');

