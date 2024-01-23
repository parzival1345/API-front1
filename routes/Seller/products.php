<?php
use App\Http\Controllers\Seller\SellerProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('/seller')->group(function (){

Route::get('/products', [SellerProductController::class, 'index'])->middleware('permission:seller_product_index');
Route::post('/products/store', [SellerProductController::class, 'store'])->middleware('permission:seller_product_store');
Route::put('/products/update/{id}', [SellerProductController::class, 'update'])->middleware('permission:seller_product_update');
Route::delete('/products/destroy/{id}', [SellerProductController::class, 'destroy'])->middleware('permission:seller_product_destroy');

});
