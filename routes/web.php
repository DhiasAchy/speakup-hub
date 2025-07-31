<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [ComplaintController::class, 'index']);
Route::post('/submit', [ComplaintController::class, 'store'])->name('complaint.store');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('fields', \App\Http\Controllers\Admin\FormFieldController::class);
});