<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'image',
        'name',
        'slug',
        'country_id',
        'state_id',
        'city_id',
        'days',
        'nights',
        'location',
        'short_description',
        'description',      
        'total_price',
        'advance_price',
        'tag',
        'status',
        'guests',
        'bedrooms',
        'beds',
        'bathrooms',
        'rating',
        'reviews_count',
        'is_guest_favourite',
    ];

    protected $casts = [
        'is_guest_favourite' => 'boolean',
        'rating'             => 'float',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function packages()
    {
        return $this->hasMany(Package::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function detail()
    {
        return $this->hasOne(PackageDetail::class);
    }

    public function galleries()
    {
        return $this->hasMany(PackageGallery::class, 'package_id');
    }

    public function bookings()
    {
        return $this->hasMany(PackageBooking::class);
    }

    public function isAvailable($checkin, $checkout)
    {
        return !$this->bookings()
            ->where('booking_status', 'confirmed')  // ✅ ye add karo
            ->where('payment_status', 'paid')        // ✅ ye add karo
            ->where(function ($q) use ($checkin, $checkout) {
                $q->whereBetween('checkin', [$checkin, $checkout])
                    ->orWhereBetween('checkout', [$checkin, $checkout])
                    ->orWhere(function ($q2) use ($checkin, $checkout) {
                        $q2->where('checkin', '<=', $checkin)
                            ->where('checkout', '>=', $checkout);
                    });
            })->exists();
    }
}