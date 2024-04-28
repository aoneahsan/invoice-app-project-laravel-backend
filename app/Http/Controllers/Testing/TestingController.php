<?php

namespace App\Http\Controllers\Testing;

use App\Http\Controllers\Controller;
use App\Http\Resources\Invoice\InvoicePDFDownloadResource;
use App\Models\Default\User;
use App\Models\Invoice\Invoice;
use App\Zaions\Enums\DisksEnum;
use App\Zaions\Helpers\ZHelpers;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

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
        ])->setOption(['defaultFont' => public_path('fonts/roboto/roboto-regular.ttf')]);
        return $pdf->download('invoice.pdf');
    }

    function uploadFileTest(Request $request)
    {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $extension  = $file->getClientOriginalExtension(); //This is to get the extension of the image file just uploaded
        $image_name = time() . '_' . rand(1000, 9999) . '.' . $extension;

        $path = Storage::putFileAs('invoices', $file, $image_name, DisksEnum::s3->value);
        Storage::disk(DisksEnum::s3->value)->setVisibility($path, 'public');
        $url = Storage::disk(DisksEnum::s3->value)->url($path);

        return response()->json([
            'filePath' => $path,
            'fileUrl' => $url,
            'filename' => $filename,
            'extension' => $extension,
            'image_name' => $image_name,
        ]);
    }

    function getUploadedFileUrl()
    {
        $image = 'invoices/1714329502_8458.png';
        $tempUrl = Storage::disk(DisksEnum::s3->value)->temporaryUrl($image, now()->addMinutes(3000));
        $url = Storage::url($image);
        return response()->json([
            'url' => $url,
            'tempUrl' => $tempUrl
        ]);
    }
}
