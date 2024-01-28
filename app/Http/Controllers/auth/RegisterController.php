<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        if ($request->role == 'seller') {
            $user = User::create([
                'user_name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'status' => 'در انتظار تایید',
            ]);
            $user->syncRoles([$request->role]);
            return response()->json([
                'status' => true,
                'message' => 'please wait for accepting admin'
            ]);
        } else {
            try {
                $user = User::create([
                    'user_name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);
                $user->syncRoles([$request->role]);
                return response()->json([
                    'status' => true,
                    'message'=> 'your account has been register'
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 500);
            }
        }
    }
}
