<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    public const CATEGORIES = ['Supercar', 'Luxury Sedan', 'Motorsport', 'SUV'];

    protected $fillable = [
        'name',
        'brand',
        'category',
        'price_per_day',
        'hp',
        'top_speed',
        'status',
        'image',
    ];

    protected $casts = [
        'price_per_day' => 'decimal:2',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('images/placeholder-car.jpg');
    }
}
