<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSellerApproval
{
    public function handle($request, Closure $next)
    {
            $userRoles []= array('admin' , 'customer');
            $userRoles2 [] = array('seller');
            $role = $request->input('role');
            if (in_array($role, $userRoles)) {
                return \response()->json([
                    'status' => true,
                    'message' => ' your account have been registered'
                ]);
            } elseif (in_array($role, $userRoles2)) {
                return response()->json(['error' => 'Access denied for sellers.'], 403);
            }else {
                return \response()->json([
                    'status' => false,
                    'message' => 'Access Denied'
                ]);
            }

    }
}
