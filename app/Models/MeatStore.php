<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MeatStore extends Pivot
{
    protected $fillable = [
        'meat_id',
        'store_id',
        'price',
        'url',
        'promo_label',
    ];

    public function casts(): array
    {
        return [
            'price' => 'integer',
        ];
    }
}
