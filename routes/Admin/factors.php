<?php
use App\Http\Controllers\admin\AdminFactorController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function (){
    /**
     * @index show all of factors
     * @store
     */
Route::get('/factors', [AdminFactorController::class, 'index'])->middleware('permission:factor_index');
Route::post('/factors/store', [AdminFactorController::class, 'store'])->middleware('permission:factor_store');
Route::delete('/factors/delete/{id}' , [AdminFactorController::class , 'destroy'])->middleware('permission:factor_delete');
});
