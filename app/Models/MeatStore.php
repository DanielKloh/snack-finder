<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MealStore extends Pivot
{
    protected $table = 'meal_store';

    protected $fillable = [
        'meal_id',
        'store_id',
        'price',
        'url',
        'promo_label',
    ];

    protected $casts = [
        'price' => 'float',
    ];
}
