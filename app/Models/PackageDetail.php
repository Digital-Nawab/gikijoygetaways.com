<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'hero_badge',
        'banner_image',
        'description',
        'highlights',
        'amenities',
        'offer_badge_text',
        'email',
        'mobile',
        'address',
        'map_url',
    ];

    protected $casts = [
        'highlights' => 'array',
        'amenities'  => 'array',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}