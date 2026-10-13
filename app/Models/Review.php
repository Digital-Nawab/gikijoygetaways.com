<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'package_id',  
        'name',
        'image',
        'location',
        'review_date',
        'rating',
        'review',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'rating'      => 'integer',
        'status'      => 'boolean',
        'sort_order'  => 'integer',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}