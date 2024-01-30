<?php

namespace App\Zaions\Helpers;
use \Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ZHelpers
{
    
    public static function sendBackRequestCompletedResponse($data)
    {
        return response()->json([
            'errors' => [],
            'data' => $data,
            'success' => true,
            'status' => 200,
            'message' => 'Request completed successfully.'
        ], 200);
    }

    public static function sendBackRequestFailedResponse($errors)
    {
        return response()->json([
            'errors' => $errors,
            'data' => [],
            'success' => false,
            'status' => 500,
            'message' => 'Error Occurred, try again later.'
        ], 500);
    }

    public static function sendBackUnauthorizedResponse($errors)
    {
        return response()->json([
            'errors' => $errors,
            'data' => [],
            'success' => false,
            'status' => 401,
            'message' => 'Unauthorized.'
        ], 401);
    }

    public static function sendBackForbiddenResponse($errors)
    {
        return response()->json([
            'errors' => $errors,
            'data' => [],
            'success' => false,
            'status' => 403,
            'message' => 'Bad request.'
        ], 403);
    }

    public static function sendBackBadRequestResponse($errors)
    {
        return response()->json([
            'errors' => $errors,
            'data' => [],
            'success' => false,
            'status' => 400,
            'message' => 'Bad request.'
        ], 400);
    }

    public static function sendBackServerErrorResponse(\Throwable $th)
    {
  
      if ($th instanceof ValidationException) {
        return response()->json(
          [
            'errors' => $th->errors(),
            'data' => [],
            'success' => false,
            'status' => 500,
            'message' => 'Error Occurred, try again later.'
          ],
          500
        );
      } else {
        return response()->json([
          'errors' => [
            'error' => [$th->getMessage()]
          ],
          'data' => [],
          'success' => false,
          'status' => 500,
          'message' => 'Error Occurred, try again later.'
        ], 500);
      }
    }

    public static function sendBackNotFoundResponse($errors)
    {
      return response()->json([
        'errors' => $errors,
        'data' => [],
        'success' => false,
        'status' => 404,
        'message' => 'Not found.'
      ], 404);
    }

    public static function zJsonDecode($value)
    {
      try {
        if ($value && is_string($value)) {
          return json_decode($value);
        } else if (!$value) {
          return null;
        } else {
          return $value;
        }
      } catch (\Throwable $th) {
        return null;
      }
    }


      // store file & return file path
  public static function storeFile(Request $request, $fileKey, $fileStorePath = 'uploaded-files')
  {
    if ($request->file($fileKey)) {
      $filePath = Storage::putFile($fileStorePath, $request->file($fileKey), 'public');

      $appUrl = env('FILESYSTEM_ROOT_URL', 'http://localhost:8000/storage/public');

      return [
        'fileUrl' => $appUrl . '/' . $filePath,
        'filePath' => $filePath,
      ];
    } else {
      return null;
    }
  }
}
