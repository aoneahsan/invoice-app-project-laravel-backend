<?php

use App\Http\Controllers\Invoice\InvoiceController;
use App\Http\Controllers\Testing\TestingController;
use App\Models\Default\User;
use App\Models\Invoice\Invoice;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// pdf download route
Route::controller(InvoiceController::class)->group(function () {
    Route::get('/user/{type}/dom/{invoice_id}/z_kasdas', 'downloadInvoicesPhpDownload');
});



Route::get('/', function () {
    return view('welcome');
});


// Testing routes 
Route::post('/pdf-export', [TestingController::class, 'pdfExportTest'])->name('download-invoice');

Route::view('/request-invoice-download', 'invoices.request-invoice-download');


Route::get('/view-pdf-download-page', function () {
    $user = User::where('email', env('SUPER_ADMIN_EMAIL', 'tester@perkforce.com'))->first();
    $invoiceData = Invoice::where('user_id', $user->id)->first();
    $invoiceLogoPath = $invoiceData->invoice_logo['path']; // please make sure this is storage path
    return view('invoices.download-invoice', [
        'invoiceData' => $invoiceData,
        'invoiceLogoPath' => $invoiceLogoPath
    ]);
});
