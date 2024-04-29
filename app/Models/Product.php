<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Basket;
use App\Models\BasketProduct;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'price',
        'is_deleted'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function baskets()
    {
        return $this->belongsToMany(Basket::class)->withPivot('quantity', 'price');
    }

    public function basketProduct()
    {
        return $this->hasMany(BasketProduct::class);
    }
}