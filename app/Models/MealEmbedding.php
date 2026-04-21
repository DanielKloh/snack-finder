<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MealEmbedding extends Model
{
    protected $fillable = [
        'meal_id',
        'text',
        'metadata',
        'embedding'
    ];

    protected function casts(): array
    {
        return [
            'metadata' => 'json',
            'embedding' => 'json'
        ];
    }

    public function meal(): BelongsTo
    {
        return $this->belongsTo(Meal::class);
    }
}