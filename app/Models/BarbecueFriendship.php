<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Barbecue;
use App\Models\User;

class BarbecueFriendship extends Model
{
    use HasFactory;

    protected $table = 'barbecues_friendships';

    protected $fillable = [
        'barbecue_id',
        'user_id',
        'guest_id',
        'is_admin',
        'accepted'
    ];

    public function barbecue()
    {
        return $this->belongsTo(Barbecue::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
