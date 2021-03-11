<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function uploadFile(Request $request)
    {
        $filePath = null;
        if ($request->hasFile("file")) {
            $filePath = $request->file("file")->store("userdata");
        }

        if ($filePath) {
            return response()->json(['data' => $filePath], 200);
        } else {
            return response()->json(['message' => "NO_FILE_FOUND"], 500);
        }
    }

    public function checkClientInvoices(Request $request, $client_id)
    {
        $items = Invoice::where("user_id", $request->user()->id)->where("client_id", $client_id)->count();
        if (empty($items)) {
            return redirect("/");
        }
        return response()->json(['data' => $items], 200);
    }
}
