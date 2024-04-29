<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\Basket;
use App\Models\User;


class BasketProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'basket_id',
        'product_id',
        'quantity',
        'price',
        'user_id',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function basket() {
        return $this->belongsTo(Basket::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
