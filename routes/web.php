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
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('fields', \App\Http\Controllers\Admin\FormFieldController::class);
});
Route::prefix('admin')->group(function () {
    Route::get('form-builder', [FormBuilderController::class, 'index'])->name('admin.form-builder');
    Route::post('form-builder/save', [FormBuilderController::class, 'save'])->name('admin.form-builder.save');
});
// end admin routes

// public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [ComplaintController::class, 'index']);
Route::post('/submit', [ComplaintController::class, 'store'])->name('complaint.store');

Route::get('complain', [FormController::class, 'index'])->name('complain.form');
Route::post('complain/submit', [FormController::class, 'submit'])->name('complain.submit');

