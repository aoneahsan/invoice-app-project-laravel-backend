<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Default\FileUploadController;
use App\Http\Controllers\Default\UserController;
use App\Http\Controllers\Default\UserDetailController;
use App\Http\Controllers\Invoice\ClientController;
use App\Http\Controllers\Invoice\InvoiceController;
use App\Http\Controllers\Testing\TestingController;
use App\Zaions\Helpers\ZHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Testing 
Route::controller(TestingController::class)->group(function () {
    Route::get('/test-api', 'test');
});

// Auth
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'Login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(FileUploadController::class)->group(function () {
        Route::post('/file-upload/getSingleFileUrl', 'getSingleFileUrl');
        Route::post('/file-upload/uploadSingleFile', 'uploadSingleFile');
        Route::put('/file-upload/deleteSingleFile', 'deleteSingleFile');
        Route::post('/file-upload/checkIfSingleFileExists', 'checkIfSingleFileExists');
        Route::post('/file-upload/uploadFiles', 'uploadFiles');
    });

    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'Logout');
        Route::post('/verify-authentication-status', 'verifyAuthState');
    });

    Route::controller(UserController::class)->group(function () {
        Route::put('/profile-details', 'profileDetails');
        Route::put('/currency-details', 'currencyDetails');
        Route::put('/bank-details', 'bankDetails');
        Route::put('/change-credentials', 'changeEmailAndPassword');
    });

    // Invoice
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/user/invoice/{type}', 'index');
        Route::post('/user/invoice/{type}/create', 'store');
        Route::get('/user/invoice/{type}/view/{invoice_id}', 'view');
        Route::put('/user/invoice/{type}/update/{invoice_id}', 'update');
        Route::delete('/user/invoice/{type}/destroy/{invoice_id}', 'destroy');

        Route::get('/user/invoice/download/{invoice_id}', 'downloadInvoicesPhpDownload');
    });

    // User Details
    Route::controller(UserDetailController::class)->group(function () {
        Route::post('/user/detail/create', 'store');
        Route::get('/user/detail/view', 'view');
        Route::put('/user/detail/update', 'update');
        Route::delete('/user/detail/destroy', 'destroy');
    });

    // Client
    Route::controller(ClientController::class)->group(function () {
        Route::get('/user/clients', 'index');
        Route::post('/user/client/create', 'store');
        Route::get('/user/client/view/{client_id}', 'view');
        Route::put('/user/client/update/{client_id}', 'update');
        Route::delete('/user/client/destroy/{client_id}', 'destroy');
    });
});
