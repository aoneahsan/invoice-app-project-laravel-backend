<?php

namespace App\Http\Controllers\Testing;

use App\Http\Controllers\Controller;
use App\Http\Resources\Invoice\InvoicePDFDownloadResource;
use App\Models\Default\User;
use App\Models\Invoice\Invoice;
use App\Zaions\Helpers\ZHelpers;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TestingController extends Controller
{
    //
    public function test()
    {
        return ZHelpers::sendBackRequestCompletedResponse([
            'items' => [['id' => 'one'], ['id' => 'two']],
        ]);
    }

    function pdfExportTest()
    {
        $user = User::where('email', env('SUPER_ADMIN_EMAIL', 'tester@perkforce.com'))->first();
        $invoiceData = Invoice::where('user_id', $user->id)->first();
        $invoiceLogoPath = $invoiceData->invoice_logo['path']; // please make sure this is storage path
        // dd($invoiceData);
        $pdf = Pdf::loadView('invoices.download-invoice', [
            'invoiceData' => $invoiceData,
            'invoiceLogoPath' => $invoiceLogoPath
        ]);
        return $pdf->download('invoice.pdf');
    }
}
