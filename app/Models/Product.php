<?php

namespace App\Models;

use Abbasudo\Purity\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use Filterable;
    use SoftDeletes;
    protected $date = ['deleted_at'];

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

