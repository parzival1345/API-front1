<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Factor;
use Illuminate\Http\Request;

class AdminFactorController extends Controller
{
    public function index() {
        $checks = Factor::all();
        return response()->json([
            'checks' => $checks,
        ]);
    }

    public function store(Request $request) {
       $factors = Factor::create([
            'user_id' => $request->user_id,
            'order_id' => $request->order_id,
            'finally_price' => $request->total_pay,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);
        return response()->json(['factors' => $factors]);
    }
}
