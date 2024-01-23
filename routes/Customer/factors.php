<?php
use App\Http\Controllers\customer\CustomerFactorController;
use Illuminate\Support\Facades\Route;

Route::prefix('/customer')->group(function (){

Route::get('/factors', [CustomerFactorController::class, 'index'])->middleware('permission:customer_factor_index');
Route::post('/factors/store', [CustomerFactorController::class, 'store'])->middleware('permission:customer_factor_store');
Route::delete('/factors/destroy/{id}', [CustomerFactorController::class, 'destroy'])->middleware('permission:customer_factor_destroy');
Route::post('/factors/update_status/{id}', [CustomerFactorController::class, 'update_status'])->middleware('permission:customer_factor_status');
});
