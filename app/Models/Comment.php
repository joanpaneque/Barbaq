<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'barbecue_id',
        'comment_id',
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barbecue()
    {
        return $this->belongsTo(Barbecue::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'comment_id')->with('user')->with('replies')->orderBy('created_at', 'desc');
    }
}
