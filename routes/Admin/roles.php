<?php

use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function () {

Route::get('/roles' , [RoleController::class , 'index'])->middleware('permission:index_roles');
Route::post('/roles/create' , [RoleController::class , 'store'])->middleware('permission:create_roles');
Route::post('/roles/update', [RoleController::class , 'update'])->middleware('permission:update_roles');

});
