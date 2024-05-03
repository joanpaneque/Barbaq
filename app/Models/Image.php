<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Barbecue;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'barbecue_id'
    ];

    public function barbecue()
    {
        return $this->belongsTo(Barbecue::class);
    }
}
