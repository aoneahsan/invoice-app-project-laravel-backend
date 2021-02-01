<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/init_urp", "SystemController@initRolePermissions");

Route::get('/profile', function () {
    return "ok";
})->name("profile");

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia\Inertia::render('Dashboard');
// })->name('dashboard');

// #################################################################
// ##################      FRONTEND ROUTES      ####################
// #################################################################

Route::group([
    // 'middleware' => [],
    'namespace' => 'Frontend',
    // "prefix" => "admin",
    // "domain" => "new"
], function () {
    // #################################################################
    // ####################      GENERIC ROUTES      ###################
    // #################################################################
    // invoice related
    Route::get("/createinvoice")->uses("PagesController@CreateInvoice")->name("createinvoice");

    // check if email is not used yet
    Route::post("/check-email-exists")->uses("AuthController@checkEmailExists")->name("check-email-exists");

    // upload files
    Route::post("/upload-files", "FrontendController@uploadFile")->name("upload-files");

    // #################################################################
    // ####################      GUEST ROUTES      #####################
    // #################################################################
    Route::group([
        "middleware" => ['guest']
    ], function () {
        Route::get("/sign-in")->uses("AuthController@loginView")->name("login.view");
        Route::post("/sign-in")->uses("AuthController@login")->name("login.action");
        Route::get("/sign-up")->uses("AuthController@registerView")->name("register.view");
        Route::post("/sign-up")->uses("AuthController@register")->name("register.action");
    });
    
    // #################################################################
    // ####################      AUTH ROUTES      ######################
    // #################################################################
    Route::group([
        "middleware" => ['auth']
    ], function () {
        Route::get('/email/verify')->uses("AuthController@completeSignupView")->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}')->uses('AuthController@verifyEmailAction')->name('verification.verify')->middleware(['signed']);
        Route::get('/email/verification-notification')->uses('AuthController@resendVerificationEmail')->middleware(['throttle:2,1'])->name('verification.send');
        Route::get('/logout', 'AuthController@logout')->name('logout');
        
        Route::get("/complete-signup")->uses("AuthController@completeSignupView")->name("complete-signup");
        Route::put("/user")->uses("AuthController@updateUserDetails")->name("user.update");
    });
    
    // #################################################################
    // ###################     VERIFIED ROUTES     #####################
    // #################################################################
    Route::group([
        // "middleware" => ['auth', "verified"]
        "middleware" => ['auth']
    ], function () {
        // Dashboard route
        Route::get('/dashboard')->uses("PagesController@Dashboard")->name('dashboard');

        // User profile routes
        Route::get('/user/profile')->uses("User\UserController@show")->name('user.profile');
        Route::put('/user')->uses("User\UserController@update")->name('user.profile.put');

        // clients routes
        Route::get("/clients")->uses("PagesController@Clients")->name("clients.view");
        Route::get("/user/clients")->uses("User\UserClientController@getClients")->name("user.clients.get");
        Route::post("/user/clients")->uses("User\UserClientController@store")->name("user.clients.post");
        Route::delete("/user/clients/{id}")->uses("User\UserClientController@destroy")->name("user.clients.delete");

        // user invoice routes
        Route::get("/invoices")->uses("PagesController@Invoices")->name("invoices.view");
        Route::get("/user/invoices")->uses("InvoiceController@getinvoices")->name("user.invoices.get");
        Route::post("/user/invoices")->uses("InvoiceController@store")->name("user.invoices.post");
        Route::delete("/user/invoices/{id}")->uses("InvoiceController@destroy")->name("user.invoices.delete");
    });

    // #################################################################
    // ########################    REDIRECTS    ########################
    // #################################################################
    Route::redirect("/register", "/sign-up");
    Route::redirect("/login", "/sign-in");

    Route::redirect("/", "/createinvoice");
});
