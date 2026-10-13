<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
     protected $fillable = [
        'image',
        'title',
        'country',
        'tour_count',
        'status'
    ];
}
