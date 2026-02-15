<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternationalHotel extends Model
{
    protected $fillable = [
        'name_en',
        'name_ar',
        'location_en',
        'location_ar',
        'location_zh',
        'description_en',
        'description_ar',
        'description_zh',
        'rating',
        'price',
        'image',
        'amenities_en',
        'amenities_ar',
        'amenities_zh',
        'active',
    ];

    protected $casts = [
        'amenities_en' => 'array',
        'amenities_ar' => 'array',
        'amenities_zh' => 'array',
        'active' => 'boolean',
        'price' => 'decimal:2',
    ];
}
