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
//****//
//------------------------------------------------------------------------//
//****//
//Admin//
//****//
//Users//
        Route::prefix('/admin')->group(function () {
            Route::get('/users', [AdminUserController::class, 'index'])->middleware('permission:user_index');
            Route::post('/users/filter', [AdminUserController::class, 'filter'])->middleware('permission:user_filter');
            Route::post('/users/store', [AdminUserController::class, 'store'])->middleware('permission:user_store');
            Route::put('/users/update/{id}', [AdminUserController::class, 'update'])->middleware('permission:user_update');
            Route::delete('/users/destroy/{id}', [AdminUserController::class, 'destroy'])->middleware('permission:user_destroy');
//Products//
            Route::get('/products', [AdminProductController::class, 'index'])->middleware('permission:product_index');
            Route::post('/products/filter', [AdminProductController::class, 'filter'])->middleware('permission:product_filter');
            Route::post('/products/store', [AdminProductController::class, 'store'])->middleware('permission:product_store');
            Route::put('/products/update/{id}', [AdminProductController::class, 'update'])->middleware('permission:product_update');
            Route::delete('/products/destroy/{id}', [AdminProductController::class, 'destroy'])->middleware('permission:product_destroy');
//Order//
            Route::get('/orders', [AdminOrderController::class, 'index'])->middleware('permission:order_index');
            Route::post('/orders/filter', [AdminOrderController::class, 'filter'])->middleware('permission:order_filter');
            Route::post('/orders/store', [AdminOrderController::class, 'store'])->middleware('permission:order_store');
            Route::put('/orders/update/{id}', [AdminOrderController::class, 'update'])->middleware('permission:order_update');
            Route::delete('/orders/destroy/{id}', [AdminOrderController::class, 'destroy'])->middleware('permission:order_destroy');
//Factor//
            Route::get('/factors', [AdminFactorController::class, 'index'])->middleware('permission:factor_index');
            Route::post('/factors/store', [AdminFactorController::class, 'store'])->middleware('permission:factor_store');
        });
//****//
//-------------------------------------------------------------------------//
//****//
//Customer//
//****//
//orders//
        Route::prefix('/customer')->group(function () {
            Route::get('/orders', [CustomerOrderController::class, 'index'])->middleware('permission:customer_order_index');
            Route::get('/orders/show/{order_id}', [CustomerOrderController::class, 'show'])->middleware('customer_order_show');
            Route::post('/orders/store', [CustomerOrderController::class, 'store'])->middleware('customer_order_store');
//factors//
            Route::get('/factors', [CustomerFactorController::class, 'index'])->middleware('customer_factor_index');
            Route::post('/factors/store', [CustomerFactorController::class, 'store'])->middleware('customer_factor_store');
            Route::delete('/factors/destroy/{id}', [CustomerFactorController::class, 'destroy'])->middleware('customer_factor_destroy');
            Route::post('/factors/update_status/{id}', [CustomerFactorController::class, 'update_status'])->middleware('customer_factor_status');
        });
//****//
//--------------------------------------------------------------------------//
//****//
//Seller//
//Products//
        Route::prefix('/seller')->group(function () {
            Route::get('/products', [SellerProductController::class, 'index'])->middleware('permission:seller_product_index');
            Route::post('/products/store' , [SellerProductController::class , 'store'])->middleware('permission:seller_product_store');
            Route::put('/products/update/{id}' , [SellerProductController::class , 'update'])->middleware('permission:seller_product_update');
            Route::delete('/products/destroy/{id}',[SellerProductController::class,'destroy'])->middleware('permission:seller_product_destroy');
//Factors//
            Route::get('/factors', [SellerFactorController::class, 'index'])->middleware('permission:seller_factor_index');
        });
});

