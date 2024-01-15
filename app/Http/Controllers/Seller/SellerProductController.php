<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use http\Env\Response;
use Illuminate\Http\Request;

class SellerProductController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;

        $products = Product::where('user_id', $id)->get();
        if (!$products->count()) {
            return response()->json([
                'message' => 'you do not have any products'
            ]);
        }
        return response()->json([$products]);
    }

    public function store(Request $request)
    {
        if (auth()->user()->role != 'seller') {
            return \response()->json([
                'status' => false,
                'message' => 'you are not seller'
            ]);
        } else {
            $product = Product::create([
                'user_id' => auth()->user()->id,
                'title' => $request->title,
                'price' => $request->price,
                'inventory' => $request->inventory,
                'description' => $request->description,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json([$product]);
        }
    }
    public function update(Request $request,$id) {
        $product_user_id = Product::find($id)->user_id;
        $user_id = auth()->user()->id;
        if ($product_user_id == $user_id) {
            $product = Product::find($id)->update([
                'title' => $request->title,
                'price' => $request->price,
                'inventory' => $request->inventory,
                'description' => $request->description,
        ]);
            return \response()->json([
                'status' => true,
                $product
            ]);
        }else {
            return \response()->json([
                'status' => true,
                'message' => 'that is not your product that you can update it'
            ]);
        }
    }

    public function destroy($id) {
        $product_user_id = Product::find($id)->user_id;
        $user_id = auth()->user()->id;
        if ($product_user_id == $user_id) {
            Product::find($id)->delete();
            return \response()->json([
                'status' => true,
                'message' => 'Your product has been removed'
            ]);
        }else{
            return \response()->json([
                'status' => false,
                'message' => 'that is not your product that you can remove it!'
            ]);
        }
    }
}
