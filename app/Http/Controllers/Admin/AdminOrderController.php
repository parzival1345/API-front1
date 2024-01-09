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
    public function index() {
        $orders = Order::all();
        return response()->json([
            'orders' => $orders,
        ]);
    }

    public function store(Request $request) {
        try {
            $total_price = 0;
            Order::create([
                'user_id' => $request->user_id,
                'title' => $request->title,
                'total_price' => $total_price,
                'created_at' => date('Y-m-d H:i:s'),

            ]);
            foreach ($request->all() as $key => $product_count) {

                if (Str::is('Product*', $key)) {

                    $product_id = substr($key, -1);
                    $products = Product::where('id', $product_id)->first();
                    $total_price += $products->price * $product_count;

                    $last_order_id = Order::select('id')->get()->max('id');
                    if ($last_order_id == null) {
                        $last_order_id = 1;
                    }

                    $order = Order::find($last_order_id);
                    $order->products()->attach($product_id, ['count' => $product_count]);
                }
            }

            Order::where('id', $last_order_id)->update([
                'total_price' => $total_price,
            ]);
            return \response()->json([
                'status' => true,
                'message' => 'order is updated'
            ]);
        }catch (\Exception $e) {
            return \response()->json([
                'status' => false,
                'message' => "{$e->getMessage()}"
            ]);
        }
    }

    public function update() {

    }
    public function destroy($id) {
        try {
            Order::find($id)->delete();
            return \response()->json([
                'status' => true,
                'message' => 'your order has been deleted'
            ]);
        }catch (\Exception $e) {
            return \response()->json([
                'status' => false,
                'message' => "{$e->getMessage()}"
            ]);
        }
    }
}
