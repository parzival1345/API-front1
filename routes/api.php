<?php

use App\Http\Controllers\admin\AdminFactorController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\customer\CustomerFactorController;
use App\Http\Controllers\customer\CustomerOrderController;
use App\Http\Controllers\Seller\SellerFactorController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Resources\UserResource;
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
//****//
//Authorize//
Route::post('/auth/register', [RegisterController::class, 'register']);
Route::post('/auth/login', [LoginController::class, 'login']);
Route::any('/auth/logout/{id}', [LogoutController::class, 'logout']);
Route::middleware('auth:sanctum')->group(function () {
    /**
     * when we are want callback just a single user or any single from the id
     */
//            Route::get('/users/resource/{id}', function ($id) {
//                return new UserResource(\App\Models\User::findOrFail($id));
//            });
    /**
     * when we are want callback a collection without id
     */
//        Route::get('/users/resource', function () {
//            return UserResource::collection(\App\Models\User::all());
//        });

    /**
     * unknown for now !!!!!!!!!!!!!!!!!**************
     */
//        Route::get('/users/resource' , function () {
//           return UserResource::collection(\App\Models\User::all()->keyBy->id);
//        });
    //Admin//
    require __DIR__ . '/Admin/send_email.php';
    require __DIR__ . '/Admin/roles.php';
    require __DIR__ . '/Admin/users.php';
    require __DIR__ . '/Admin/products.php';
    require __DIR__ . '/Admin/orders.php';
    require __DIR__ . '/Admin/factors.php';
    //Customer//
    require __DIR__ . '/Customer/orders.php';
    require __DIR__ . '/Customer/factors.php';
    //Seller//
    require __DIR__ . '/Seller/products.php';
    require __DIR__ . '/Seller/factors.php';
});

