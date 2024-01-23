<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function login(LoginRequest $request) {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                "status" => "false",
                "text" => "your login failed"
            ]);
        }else {
            $user = auth()->user();
            $token =  $user->createToken("API TOKEN")->plainTextToken;
            return response()->json([
                'token' => $token,
                "status" => "true",
                "text" => "you are login "
            ]);

        }
    }
    public function redirectToProvider() {
        return Socialite::driver('google')->redirect();
    }

    public function handleGithubCallback(Request $request) {
        $googleUser = Socialite::driver('google')->user();

        return response()->json([
            'token' => $googleUser->token,
            'user' => $googleUser->user
        ]);
    }
    public function index(): view
    {
        return view('google_login');
    }
}
