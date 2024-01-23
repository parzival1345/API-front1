<?php
use App\Http\Controllers\Admin\AdminProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function () {
    /**
     * @index show all of products
     * @filter filtering products for using better
     * @store create products from admin
     * @update update information of products from admin
     * @destroy delete products from admin
     */
Route::get('/products', [AdminProductController::class, 'index'])->middleware('permission:product_index');
Route::post('/products/filter', [AdminProductController::class, 'filter'])->middleware('permission:product_filter');
Route::post('/products/store', [AdminProductController::class, 'store'])->middleware('permission:product_store');
Route::put('/products/update/{id}', [AdminProductController::class, 'update'])->middleware('permission:product_update');
Route::delete('/products/destroy/{id}', [AdminProductController::class, 'destroy'])->middleware('permission:product_destroy');
});
