<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class State extends Model
{
    protected $fillable = [
        'country_id',
        'state_name',
        'state_image',
        'slug',
        'description',
        'status',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function cities()
    {
        return $this->hasMany(\App\Models\City::class, 'state_id');
    }

    public function packages()
    {
        return $this->hasMany(\App\Models\Package::class, 'state_id');
    }
    // Auto-generate slug
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($state) {
            if (empty($state->slug)) {
                $state->slug = Str::slug($state->state_name);
            }
        });
    }
}
