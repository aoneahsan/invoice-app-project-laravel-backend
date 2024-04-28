<?php

namespace App\Http\Controllers\Default;

use App\Http\Controllers\Controller;
use App\Zaions\Enums\DisksEnum;
use App\Zaions\Helpers\ZHelpers;
use Illuminate\Http\Request;
use Mockery\Undefined;

use function PHPUnit\Framework\isEmpty;

class FileUploadController extends Controller
{
    public function uploadSingleFile(Request $request)
    {
        // try {
        $request->validate([
            'file' => 'required|file',
        ]);

        // ? why are you using spaces in the file name?
        // Do not use spaces in file names
        if ($request->hasFile('file')) {
            // return ZHelpers::storeFileInS3($request, 'file');
            $fileData = ZHelpers::storeFileInS3($request, 'file');
            $filePath = $fileData['path'];
            $fileUrl = $fileData['url'];
            $fileName = $fileData['fileName'];
            if ($fileUrl !== null && $filePath !== null) {
                // ? Talha why were you sending the file in the response?
                // 'item' => ['fileName' => $fileName, 'filePath' => $filePath, 'fileUrl' => $fileUrl, 'file' => $request->file]
                return ZHelpers::sendBackRequestCompletedResponse([
                    'item' => ['fileName' => $fileName, 'filePath' => $filePath, 'fileUrl' => $fileUrl]
                ]);
            } else {
                return ZHelpers::sendBackRequestFailedResponse(['file' => 'File could not be uploaded.']);
            }
        } else {
            return ZHelpers::sendBackRequestFailedResponse(['file' => 'File not found.']);
        }
        // } catch (\Throwable $th) {
        //     //throw $th;
        //     return ZHelpers::sendBackServerErrorResponse($th);
        // }
    }

    public function uploadFiles(Request $request)
    {
        try {
            $request->validate([
                'files.*' => 'file|max:2000'
            ]);

            $filesData = [];
            if ($request->files) {
                foreach ($request->files as $files) {
                    foreach ($files as $file) {
                        $filesData[] = [
                            'name' => $file[0]->getClientOriginalName(),
                            'ch' => 0,
                            'count1' => $request->get('files') ? count($request->get('files')) : null,
                            'count2' => $request->files ? count($request->files) : null,
                            // 'count3' => $file ? count($file) : null
                        ];
                    }
                }
            }

            return response()->json(['data' => [
                'filesData' => $filesData
            ]]);
        } catch (\Throwable $th) {
            //throw $th;
            return ZHelpers::sendBackServerErrorResponse($th);
        }
    }

    public function getSingleFileUrl(Request $request)
    {
        $request->validate([
            'filePath' => 'string'
        ]);
        $fileUrl = ZHelpers::getFullFileUrl($request->filePath);

        return response()->json(['data' => ['fileUrl' => $fileUrl]]);
    }

    public function checkIfSingleFileExists(Request $request)
    {

        $request->validate([
            'filePath' => 'string'
        ]);
        $fileExists = ZHelpers::checkIfFileExists($request->filePath);

        return response()->json(['data' => [
            'fileExists' => $fileExists
        ]]);
    }

    public function deleteSingleFile(Request $request)
    {
        $request->validate([
            'filePath' => 'string'
        ]);
        $deleted = ZHelpers::deleteFile($request->filePath);

        return response()->json(['data' => [
            'deleted' => $deleted
        ]]);
    }
}
