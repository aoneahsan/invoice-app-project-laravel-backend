<?php

use App\Http\Controllers\Testing\TestingController;
use App\Http\Resources\Invoice\InvoiceResource;
use App\Models\Default\User;
use App\Models\Invoice\Invoice;
use App\Zaions\Enums\InvoiceType;
use App\Zaions\Enums\PermissionsEnum;
use App\Zaions\Enums\RolesEnum;
use App\Zaions\Helpers\ZHelpers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/z-testing', function () {

    // $allPermissionsCases = PermissionsEnum::cases();
    // $allPermissions = [];

    // foreach ($allPermissionsCases as $permission) {
    //     $permissionName = $permission->value;

    //     $allPermissions[] = Permission::firstOrCreate(['name' => $permissionName]);
    // }

    // dd($allPermissions);


    // dd('okay', testDownloadPDF());
    return 'ok';
});

Route::post('/pdf-export', [TestingController::class, 'pdfExportTest'])->name('download-invoice');

Route::view('/request-invoice-download', 'invoices.request-invoice-download');


// function testDownloadPDF()
// {
//     $user = User::where('email', env('SUPER_ADMIN_EMAIL', 'tester@zaions.com'))->first();

//     $invoice = Invoice::where("user_id", $user->id)->where("invoice_type", InvoiceType::inv->name)->first();

//     if (empty($invoice)) {
//         return ZHelpers::sendBackNotFoundResponse([
//             'item' => ['Invoice is not found.']
//         ]);
//     }
//     $itemResource = new InvoiceResource($invoice);
//     $pdfData = [
//         "data" => [
//             "itemResource" => $itemResource,
//             "user" => $user,
//             "item" => $invoice
//         ]
//     ];


//     $pdf = Pdf::loadView('invoices/download-invoice', $pdfData);

//     // return $pdf->download('invoice.pdf');
//     return $pdf->output();
// }

Route::get('/testing-storage', function () {
    return Storage::read('uploaded-files/MD4hlPZ3gYQke5y8HplE053sHQ4K4IUj8BsqB4Qu.jpg');
});
