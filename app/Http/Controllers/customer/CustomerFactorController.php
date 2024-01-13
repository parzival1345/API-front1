<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Factor;
use App\Models\Order;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;

class CustomerFactorController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        $checks = Factor::where('user_id', $id)->get();
        return response()->json([$checks]);
    }

    public function store(Request $request)
    {
        $id = auth()->user()->id;
        $factor = Factor::create([
            'user_id' => $id,
            'order_id' => $request->order_id,
            'finally_price' => $request->total_pay,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return response()->json([$factor]);
    }

    public function destroy($id)
    {
        $factor_user_id = Factor::find($id)->user_id;
        $user_id = auth()->user()->id;
        if ($user_id == $factor_user_id) {
            Factor::find($id)->delete();
            return response()->json([
                'status' => true,
                'message' => 'your factor is deleted',
            ]);
        } else {
            return response()->json([
                'message' => 'that is not your factor',
            ]);
        }
    }

    public function update_status($id)
    {
        $factor_user_id = Factor::find($id)->user_id;
        $user_id = auth()->user()->id;
        if ($user_id == $factor_user_id) {
            $status = Factor::findOrFail($id);
            $status->update(['status' => 'پرداخت شده']);
            return response([
                'status' => true,
                'message' => 'your status will be update'
            ], 200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'you can not update this factor status Because that is not your factor'
            ]);
        }
    }
}
