<?php
use App\Http\Controllers\Seller\SellerFactorController;
use Illuminate\Support\Facades\Route;

Route::prefix('/seller')->group(function (){
Route::get('/factors', [SellerFactorController::class, 'index'])->middleware('permission:seller_factor_index');
});
