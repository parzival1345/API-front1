<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_product extends Model
{
    protected $table = 'order_product';
    use HasFactory;

    protected $guarded = ['id'];
}
