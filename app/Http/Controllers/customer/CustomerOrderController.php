<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerOrderController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        $orders = Order::where('user_id', $id)->with('products')->get();
        return response()->json([
            'orders' => $orders,
        ]);
    }

    public function show(Request $request, $order_id)
    {
        $order = Order::with('products')->findOrFail($order_id);
        $user_id = Auth::id();

        if ($order->user_id != $user_id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $total_price = $order->products->sum('price');
        $selectedProducts = $order->products->take(3);

        $responseData = [
            'selectedProducts' => $selectedProducts,
            'orderName' => $order->title,
            'userId' => $user_id,
            'total_price' => $total_price
        ];
        return \response()->json([
            $responseData
        ]);
    }

    public function store(Request $request)
    {

        $total_price = 0;
        foreach ($request->products as $product) {
            $price = Product::find($product['product_id'])->price;
            $total_price += $price * $product['count'];
        }
        $orders = Order::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'total_price' => $total_price,
        ]);
        foreach ($request->products as $product) {
            $orders->products()->attach($product['product_id'], ['count' => $product['count']]);
        }
        return response()->json([$orders]);
    }
    public function update(Request $request,$id) {
        $order = Order::find($id);
        $total_price = 0;

        foreach ($request->products as $product) {
            $price = Product::find($product['product_id'])->price;
            $total_price += $price * $product['count'];
            $order->products()->syncWithoutDetaching([$product['product_id'] => ['count' => $product['count']]]);
        }

        $order->update([
            'title' => $request->title,
            'user_id' => auth()->user()->id,
            'total_price' => $total_price
        ]);

        return response()->json([
            'status' => true,
            'order' => $order,
            'products' => $order->products ,
        ]);
    }
}
