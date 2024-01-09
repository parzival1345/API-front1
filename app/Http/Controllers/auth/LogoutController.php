<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;

class LogoutController extends Controller
{
    public function logout($id) {
        $user = User::find($id);
        $user->tokens->each(function ($token) {
        $token->delete();
        });
        return response()->json([
            'status' => true,
            'message' => 'you are logout from the site'
        ]);
    }
}
