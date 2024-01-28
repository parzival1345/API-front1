<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    public function handle($request, Closure $next)
    {
        $Role= $request->input('role');
        $UserRoles [] = array('admin' , 'seller' , 'customer');
        if (in_array($Role , $UserRoles)) {
            return $next($request);
        }else {
            return response()->json(['error' => 'Access denied.'], 403);
        }
    }
}
