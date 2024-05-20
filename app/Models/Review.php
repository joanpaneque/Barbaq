<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Barbecue;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'guest_id',
        'barbecue_id',
        'rating',
        'content'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guest()
    {
        return $this->belongsTo(User::class);
    }

    public function barbecue()
    {
        return $this->belongsTo(Barbecue::class);
    }
}
