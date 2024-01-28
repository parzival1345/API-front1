<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Mail\MyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(EmailRequest $request)
    {
        $emailData = [
            'user_name' => $request->input('user_name'),
        ];

        Mail::to($request->input('email'))->send(new MyMail($emailData));

        return response()->json(['message' => 'Email sent successfully']);
    }
}
