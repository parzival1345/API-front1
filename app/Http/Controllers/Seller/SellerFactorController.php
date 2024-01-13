<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Factor;

class SellerFactorController extends Controller
{
    public function index() {
        $id = auth()->user()->id;
        $factor = Factor::where('user_id',$id)->with('products');
        return response()->json([$factor]);
    }
}
