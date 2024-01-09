<?php

use App\Http\Controllers\admin\AdminFactorController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\RegisterController;
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
Route::post('/auth/register', [RegisterController::class,'register']);
Route::post('/auth/login', [LoginController::class,'login']);
Route::any('/auth/logout/{id}', [LogoutController::class , 'logout']);
Route::middleware('auth:sanctum')->group(function () {
//****//
//------------------------------------------------------------------------//
//****//
//Admin//
//****//
//Users//
    Route::middleware('Admin')->group(function () {
Route::prefix('/admin')->group(function () {
    Route::get('/users' , [AdminUserController::class , 'index']);
    Route::get('/users/filter' ,[AdminUserController::class , 'filter']);
    Route::post('/users/store' , [AdminUserController::class,'store']);
    Route::put('/users/update/{id}' , [AdminUserController::class , 'update']);
    Route::delete('/users/destroy/{id}' ,[AdminUserController::class, 'destroy']);
//Products//
    Route::get('/products' , [AdminProductController::class , 'index']);
    Route::post('/products/store' , [AdminProductController::class , 'store']);
    Route::put('/products/update/{id}' , [AdminProductController::class , 'update']);
    Route::delete('/products/destroy/{id}' , [AdminProductController::class , 'destroy']);
//Order//
    Route::get('/orders' , [AdminOrderController::class , 'index']);
    Route::post('/orders/store' , [AdminOrderController::class , 'store']);
    Route::put('/orders/update/{id}' , [AdminOrderController::class , 'update']);
    Route::delete('/orders/destroy/{id}' , [AdminOrderController::class , 'destroy']);
//Factor//
    Route::get('/factors' , [AdminFactorController::class , 'index']);
    Route::post('/factors/store' , [AdminFactorController::class , 'store']);
});
    });
//****//
//-------------------------------------------------------------------------//
//****//
});
