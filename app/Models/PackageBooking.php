<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageBooking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'package_id',
        'name',
        'email',
        'phone',        
        'adult',
        'child',
        'total_people',
        'checkin',
        'checkout',
        'message',
        'source',      
        'booking_status',
        'payment_status',
        'razorpay_order_id',
        'razorpay_payment_id',
    ];

    protected $casts = [
        'checkin'  => 'date',
        'checkout' => 'date',
    ];

    // ─────────────────────────────────────────────
    // Relationship
    // ─────────────────────────────────────────────
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    // ─────────────────────────────────────────────
    // Date Availability Check
    // Sirf confirmed + paid bookings block hongi
    // ─────────────────────────────────────────────
    public function isAvailable($checkin, $checkout): bool
    {
        return !PackageBooking::where('package_id', $this->id)
            ->where('booking_status', 'confirmed')
            ->where('payment_status', 'paid')
            ->where(function ($query) use ($checkin, $checkout) {
                $query->whereBetween('checkin', [$checkin, $checkout])
                      ->orWhereBetween('checkout', [$checkin, $checkout])
                      ->orWhere(function ($q) use ($checkin, $checkout) {
                          $q->where('checkin', '<=', $checkin)
                            ->where('checkout', '>=', $checkout);
                      });
            })
            ->exists();
    }

    // ─────────────────────────────────────────────
    // Scopes
    // ─────────────────────────────────────────────
    public function scopeConfirmed($query)
    {
        return $query->where('booking_status', 'confirmed');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopePending($query)
    {
        return $query->where('booking_status', 'pending');
    }
}