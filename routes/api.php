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
            Route::get('/users', [AdminUserController::class, 'index'])->name('user_index')->middleware('permission:user_index');
            Route::post('/users/filter', [AdminUserController::class, 'filter'])->name('user_filter')->middleware('permission:user_filter');
            Route::post('/users/store', [AdminUserController::class, 'store'])->name('user_store')->middleware('permission:user_store');
            Route::put('/users/update/{id}', [AdminUserController::class, 'update'])->name('user_update')->middleware('permission:user_update');
            Route::delete('/users/destroy/{id}', [AdminUserController::class, 'destroy'])->name('user_destroy')->middleware('permission:user_destroy');
//Products//
            Route::get('/products', [AdminProductController::class, 'index'])->name('product_index')->middleware('permission:product_index');
            Route::post('/products/filter', [AdminProductController::class, 'filter'])->name('product_filter')->middleware('permission:product_filter');
            Route::post('/products/store', [AdminProductController::class, 'store'])->name('product_store')->middleware('permission:product_store');
            Route::put('/products/update/{id}', [AdminProductController::class, 'update'])->name('product_update')->middleware('permission:product_update');
            Route::delete('/products/destroy/{id}', [AdminProductController::class, 'destroy'])->name('product_destroy')->middleware('permission:product_destroy');
//Order//
            Route::get('/orders', [AdminOrderController::class, 'index'])->name('order_index')->middleware('permission:order_index');
            Route::post('/orders/filter', [AdminOrderController::class, 'filter'])->name('order_filter')->middleware('permission:order_filter');
            Route::post('/orders/store', [AdminOrderController::class, 'store'])->name('order_store')->middleware('permission:order_store');
            Route::put('/orders/update/{id}', [AdminOrderController::class, 'update'])->name('order_update')->middleware('permission:order_update');
            Route::delete('/orders/destroy/{id}', [AdminOrderController::class, 'destroy'])->name('order_destroy')->middleware('permission:order_destroy');
//Factor//
            Route::get('/factors', [AdminFactorController::class, 'index'])->name('factor_index')->middleware('permission:factor_index');
            Route::post('/factors/store', [AdminFactorController::class, 'store'])->name('factor_store')->middleware('permission:factor_store');
        });
//****//
//-------------------------------------------------------------------------//
//****//
//Customer//
//****//
//orders//
        Route::prefix('/customer')->group(function () {
            Route::get('/orders', [CustomerOrderController::class, 'index'])->name('cus_order_index')->middleware('permission:cus_order_index');
            Route::get('/orders/show/{order_id}', [CustomerOrderController::class, 'show'])->name('cus_order_show')->middleware('cus_order_show');
            Route::post('/orders/store', [CustomerOrderController::class, 'store'])->name('cus_order_store')->middleware('cus_order_store');
//factors//
            Route::get('/factors', [CustomerFactorController::class, 'index'])->name('cus_factor_index')->middleware('cus_factor_index');
            Route::post('/factors/store', [CustomerFactorController::class, 'store'])->name('cus_factor_store')->middleware('cus_factor_store');
            Route::delete('/factors/destroy/{id}', [CustomerFactorController::class, 'destroy'])->name('cus_factor_destroy')->middleware('cus_factor_destroy');
            Route::post('/factors/update_status/{id}', [CustomerFactorController::class, 'update_status'])->name('cus_factor_status')->middleware('cus_factor_status');
        });
//****//
//--------------------------------------------------------------------------//
//****//
//Seller//
//Products//
        Route::prefix('/seller')->group(function () {
            Route::get('/products', [SellerProductController::class, 'index'])->name();
            Route::post('/products/store' , [SellerProductController::class , 'store']);
            Route::put('/products/update/{id}' , [SellerProductController::class , 'update']);
            Route::delete('/products/destroy/{id}',[SellerProductController::class,'destroy']);
//Factors//
            Route::get('/factors', [SellerFactorController::class, 'index']);
        });
});

