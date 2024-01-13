<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request) {
        if ($request->role == 'seller') {
            User::create([
                'user_name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password),
                'status' => 'در انتظار تایید',
            ]);
            return view('authorize/register')->with('message' , 'لطفا منتظر تایید ادمین باشید');
        }else {
            try {
                User::create([
                    'user_name' => $request->name,
                    'email' => $request->email,
                    'role' => $request->role,
                    'password' => Hash::make($request->password)
                ]);

                return redirect('/login');

            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 500);
            }
        }
    }
}
