<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'cart_value',
        'expiry_date',
    ];

    protected $casts = [
        'expiry_date' => 'datetime',
    ];

    public function isExpired()
    {
        return $this->expiry_date->isPast();
    }

    public function scopeActive($query)
    {
        return $query->where('expiry_date', '>', now());
    }
}
