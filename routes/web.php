<?php

use App\Zaions\Enums\PermissionsEnum;
use App\Zaions\Enums\RolesEnum;
use Illuminate\Support\Facades\Route;
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

    $allPermissionsCases = PermissionsEnum::cases();
    $allPermissions = [];

    foreach ($allPermissionsCases as $permission) {
        $permissionName = $permission->value;

        $allPermissions[] = Permission::firstOrCreate(['name' => $permissionName]);
    }

    dd($allPermissions);
});
