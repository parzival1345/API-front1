<?php
use App\Http\Controllers\customer\CustomerOrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('/customer')->group(function (){

Route::get('/orders', [CustomerOrderController::class, 'index'])->middleware('permission:customer_order_index');
Route::get('/orders/show/{order_id}', [CustomerOrderController::class, 'show'])->middleware('permission:customer_order_show');
Route::post('/orders/update/{id}' , [CustomerOrderController::class , 'update'])->middleware('permission:customer_orders_update');
Route::post('/orders/store', [CustomerOrderController::class, 'store'])/*->middleware(['name' => 'customer_orders_create'])*/;

});
