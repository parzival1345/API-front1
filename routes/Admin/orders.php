<?php
use App\Http\Controllers\Admin\AdminOrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function () {
    /**
     * @index show all of orders that users created
     * @filter filtering orders for using better
     * @store create orders from admin
     * @update updating order information
     * @destroy delete order from admin
     */
Route::get('/orders', [AdminOrderController::class, 'index'])->middleware('permission:order_index');
Route::post('/orders/filter', [AdminOrderController::class, 'filter'])->middleware('permission:order_filter');
Route::post('/orders/store', [AdminOrderController::class, 'store'])->middleware('permission:order_store');
Route::put('/orders/update/{id}', [AdminOrderController::class, 'update'])->middleware('permission:order_update');
Route::delete('/orders/destroy/{id}', [AdminOrderController::class, 'destroy'])->middleware('permission:order_destroy');
});
