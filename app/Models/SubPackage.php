<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubPackage extends Model
{
    protected $fillable = [
        'package_id',
        'badge',
        'editor_badge',
        'name',
        'features',
        'price',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'features'    => 'array',
        'is_featured' => 'boolean',
        'price'       => 'decimal:2',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}