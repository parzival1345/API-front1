<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'user_id',
            'title',
            'price',
            'inventory',
            'description',
        ];

    public function orders() {
        return $this->belongsToMany(Order::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}

