<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'preparation_time_minutes',
        'difficulty',
        'fat_level',
        'protein_level',
        'average_cost',
        'best_served_with',
        'recommendation_notes',
        'is_premium',
        'is_for_large_group',
        'is_beginner_friendly',
        'is_vegetarian',
        'is_vegan',
    ];

    protected $casts = [
        'preparation_time_minutes' => 'integer',
        'average_cost' => 'float',

        'is_premium' => 'boolean',
        'is_for_large_group' => 'boolean',
        'is_beginner_friendly' => 'boolean',
        'is_vegetarian' => 'boolean',
        'is_vegan' => 'boolean',

        'fat_level' => 'string',
        'protein_level' => 'string',
        'difficulty' => 'string',
    ];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function cover(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')
            ->where('is_cover', true);
    }

    public function stores(): BelongsToMany
    {
        return $this->belongsToMany(Store::class)
            ->using(MealStore::class)
            ->withPivot('price', 'promo_label', 'url')
            ->withTimestamps();
    }
}
