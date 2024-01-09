<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class AdminProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return response()->json(['products' => $products]);
    }

    public function store(Request $request) {
        try {
            Product::create([
                'title'=>$request->product_name,
                'price'=>$request->price,
                'inventory'=>$request->amount_available,
                'description'=>$request->explanation,
                'created_at'=>date('Y-m-d H:i:s'),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'your products will be save in database',
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "{$e->getMessage()}",
            ]);
        }
    }

    public function update(Request $request , $id) {
        try {
            $products =  Product::find($id)->updateOrFail([
                'title'=>$request->product_name,
                'price'=>$request->price,
                'inventory'=>$request->amount_available,
                'description'=>$request->explanation,
            ]);
            return response()->json([
                'products' => $products
            ]);
        }catch (\Exception $e) {
            return \response()->json([
                'status' => false,
                'message' => "{$e->getMessage()}"
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $products = Product::find($id);
            $products->delete();
            return \response()->json([
                'status' => true,
                'message' => 'product is deleted'
            ]);
        } catch (\Exception $e) {
            return \response()->json([
                'status' => false,
                'message' => "{$e->getMessage()}",
            ]);
        }
    }
}
