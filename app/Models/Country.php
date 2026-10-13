<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'status'
    ];
   public function states()
{
    return $this->hasMany(State::class, 'country_id');
}

public function packages()
{
    return $this->hasMany(Package::class, 'country_id');
}
}
