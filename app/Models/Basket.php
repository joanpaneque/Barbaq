<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Barbecue;
use App\Models\Product;

class Basket extends Model
{
    use HasFactory;

    protected $fillable = [
        'barbecue_id',
    ];

    public function barbecue()
    {
        return $this->belongsTo(Barbecue::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price', 'user_id');
    }
}
