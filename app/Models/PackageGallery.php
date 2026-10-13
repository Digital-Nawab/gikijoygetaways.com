<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageGallery extends Model
{
    protected $fillable = [
        'package_id',
        'image',
        'caption',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
