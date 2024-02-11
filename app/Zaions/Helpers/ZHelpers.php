<?php

namespace App\Zaions\Helpers;
use \Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ZHelpers
{
 /**
 * Send a successful response with data.
 *
 * @param  mixed  $data Data to be sent in the response.
 * @return \Illuminate\Http\JsonResponse
 */   
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

    /**
 * Send a response indicating a failed request with errors.
 *
 * @param  array  $errors Errors encountered during the request.
 * @return \Illuminate\Http\JsonResponse
 */
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

    /**
 * Send a response indicating an unauthorized request.
 *
 * @param  array  $errors Errors encountered during the unauthorized request.
 * @return \Illuminate\Http\JsonResponse
 */
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

    /**
 * Send a response indicating a forbidden request.
 *
 * @param  array  $errors Errors encountered during the forbidden request.
 * @return \Illuminate\Http\JsonResponse
 */
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

    /**
 * Send a response indicating a bad request.
 *
 * @param  array  $errors Errors encountered during the bad request.
 * @return \Illuminate\Http\JsonResponse
 */
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

    /**
 * Send a response indicating a server error.
 *
 * @param  \Throwable  $th Throwable error encountered.
 * @return \Illuminate\Http\JsonResponse
 */
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

    /**
 * Send a response indicating a not found resource.
 *
 * @param  array  $errors Errors encountered when the resource is not found.
 * @return \Illuminate\Http\JsonResponse
 */
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

    /**
 * Decode JSON data safely.
 *
 * @param  mixed  $value JSON data to decode.
 * @return mixed|null Decoded JSON data or null if decoding fails.
 */
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


   /**
 * Store an uploaded file and return its file path.
 *
 * @param  \Illuminate\Http\Request  $request Request object containing the file.
 * @param  string  $fileKey Key used to retrieve the file from the request.
 * @param  string  $fileStorePath Path where the file should be stored.
 * @return array|null Array containing the file URL and file path, or null if file not found.
 */
  public static function storeFile(Request $request, $fileKey, $fileStorePath = 'public/uploaded-files')
  {
    if ($request->file($fileKey)) {
      $filePath = Storage::putFile($fileStorePath, $request->file($fileKey), ['public']);

      $appUrl = env('FILESYSTEM_ROOT_URL', 'http://localhost:8000/storage');

      return [
        'fileUrl' => $appUrl . '/' . $filePath,
        'filePath' => $filePath,
      ];
    } else {
      return null;
    }
  }

/**
 * Check if a file exists.
 *
 * @param  string|null  $filePath Path of the file to check.
 * @return bool True if file exists, false otherwise.
 */
    public static function checkIfFileExists($filePath)
    {
      return $filePath && Storage::exists($filePath);
    }
  
/**
 * Get the full URL of a file.
 *
 * @param  string|null  $filePath Path of the file.
 * @return string|null Full URL of the file, or null if file not found.
 */
    public static function getFullFileUrl($filePath): string | null
    {
      if (ZHelpers::checkIfFileExists($filePath)) {
        $fileUrl = Storage::url($filePath);
  
        $appUrl = env('FILESYSTEM_ROOT_URL', 'http://localhost:8000/storage');
  
        return $appUrl . $fileUrl;
      } else {
        return null;
      }
    }

 /**
 * Delete a file if it exists.
 *
 * @param  string|null  $filePath Path of the file to delete.
 * @return bool True if file was deleted successfully, false otherwise.
 */
  public static function deleteFile($filePath)
  {
    if ($filePath && ZHelpers::checkIfFileExists($filePath)) {
      $deleted = Storage::delete($filePath);

      return $deleted;
    } else {
      return false;
    }
  }

  /**
 * Generate a unique numeric OTP (One-Time Password).
 *
 * @param  int  $length Length of the OTP.
 * @return string Generated OTP.
 */
  public static function generateUniqueNumericOTP($length = 6)
  {
    $otp = '';
    $characters = '0123456789'; // Only numeric characters

    // Calculate the maximum index for the character set
    $maxIndex = strlen($characters) - 1;

    // Generate the OTP
    for ($i = 0; $i < $length; $i++) {
      // Use modulo to ensure the character is within the numeric character set
      $otp .= $characters[mt_rand(0, $maxIndex)];
    }

    return $otp;
  }
}
