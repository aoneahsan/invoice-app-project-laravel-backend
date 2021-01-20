<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/', [App\Http\Controllers\InvoiceController::class, 'invoice_list'])->name('invoice.list')->middleware('auth');

Route::get('/invoice/create', [App\Http\Controllers\InvoiceController::class, 'invoice'])->name('invoice.create')->middleware('auth');
Route::get('/invoice/{id}/edit', [App\Http\Controllers\InvoiceController::class, 'edit'])->name('invoice.edit')->middleware('auth');

Route::post('/create-client', [App\Http\Controllers\InvoiceController::class, 'createClient'])->name('create.client');
Route::post('/create-invoice', [App\Http\Controllers\InvoiceController::class, 'createInvoice'])->name('create.invoice');
Route::post('/update-user', [App\Http\Controllers\InvoiceController::class, 'updateUser'])->name('update.user');


