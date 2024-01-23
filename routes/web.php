<?php

use App\Http\Controllers\auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return '123123';
//});


Route::get('/dashbord' , [LoginController::class , 'index']);
Route::get('/auth/login/google' , [LoginController::class , 'redirectToProvider'])->name('login');
Route::get('/auth/google_login/callback' , [LoginController::class , 'handleGithubCallback']);
