<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminOrderController extends Controller
{
    public function filter(Request $request)
    {
        $filter = Order::query();
        $total_price = $request->input('total_price');
        $user_id = $request->input('user_id');
        $title = $request->input('title');
        if ($total_price) {
            $filter->where('total_price', $total_price);
        }
        if ($user_id) {
            $filter->where('user_id', $user_id);
        }
        if ($title) {
            $filter->where('title', $title);
        }
        $filterOrder = $filter->get();
        return \response()->json([
            'filterOrder' => $filterOrder,
        ]);
    }

    public function index()
    {
        $orders = Order::all();
        return response()->json([
            'orders' => $orders,
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
            'user_id' => $request->user_id,
            'title' => $request->title,
            'total_price' => $total_price
        ]);
        foreach ($request->products as $product) {
            $orders->products()->attach($product['product_id'], ['count', $product['count']]);
        }
        return \response()->json($orders);
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $total_price = 0;

        foreach ($request->products as $product) {
            $price = Product::find($product['product_id'])->price;
            $total_price += $price * $product['count'];
            $order->products()->syncWithoutDetaching([$product['product_id'] => ['count' => $product['count']]]);
        }

        $order->update([
            'title' => $request->title,
            'user_id' => $request->user_id,
            'total_price' => $total_price
        ]);

        return response()->json([
            'status' => true,
            'order' => $order,
            'products' => $order->products ,
        ]);
    }

    public function destroy($id)
    {
        try {
            Order::find($id)->delete();
            return \response()->json([
                'status' => true,
                'message' => 'your order has been deleted'
            ]);
        } catch (\Exception $e) {
            return \response()->json([
                'status' => false,
                'message' => "{$e->getMessage()}"
            ]);
        }
    }
}
