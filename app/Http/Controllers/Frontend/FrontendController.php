<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
}
