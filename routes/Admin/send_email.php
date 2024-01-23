<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::post('/send-email', [EmailController::class, 'sendEmail'])/*->middleware('permission:user_send_email')*/;

});
