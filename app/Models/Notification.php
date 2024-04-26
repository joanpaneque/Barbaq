<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message',
        'primary_link',
        'secondary_link',
        'primary_link_text', 
        'secondary_link_text', 
        'seen'
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
