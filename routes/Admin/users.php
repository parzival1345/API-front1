<?php

use App\Http\Controllers\Admin\AdminUserController;
use Illuminate\Support\Facades\Route;
Route::prefix('/admin')->group(function (){
    /**
     * @index show all of users
     * @upload_image can upload the image for users
     * @filter for filtering users for using better
     * @store create a user from admin
     * @update update information of users from admin
     * @destroy delete users with SoftDelete from admin
     */
Route::get('/users', [AdminUserController::class, 'index'])->middleware('permission:user_index');
Route::post('/users/{image}/upload-image' , [AdminUserController::class , 'uploadImage']);
Route::post('/users/filter', [AdminUserController::class, 'filter'])->middleware('permission:user_filter');
Route::post('/users/store', [AdminUserController::class, 'store'])->middleware('permission:user_store');
Route::post('/users/update/{id}', [AdminUserController::class, 'update'])->middleware('permission:user_update');
Route::delete('/users/destroy/{id}', [AdminUserController::class, 'destroy'])->middleware('permission:user_destroy');
Route::post('/users/accept' , [AdminUserController::class , 'accept'])->middleware('permission:user_seller_accept');
Route::post('/users/reject' , [AdminUserController::class , 'reject'])->middleware('permission:user_seller_reject');
});
