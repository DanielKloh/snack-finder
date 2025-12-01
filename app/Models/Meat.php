<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Meat extends Model
{
    use HasFactory;

    /**
     * O nome da tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'meats';

    /**
     * Os atributos que são mass assignable (preenchíveis em massa).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'cut_type',
        'description',
        'fat_level',
        'cooking_time_minutes',
        'difficulty',
        'cost_per_kg_approx',
        'best_served_with',
        'recommendation_notes',
        'is_premium',
        'is_for_large_group',
        'is_beginner_friendly',
    ];

    /**
     * Os atributos que devem ser convertidos (cast) para tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'cooking_time_minutes' => 'integer',
        'cost_per_kg_approx' => 'float', // Converte o DECIMAL para float ou double
        'is_premium' => 'boolean',
        'is_for_large_group' => 'boolean',
        'is_beginner_friendly' => 'boolean',
        'fat_level' => 'string', // Embora seja ENUM, é tratado como string
        'tenderness' => 'string',
        'difficulty' => 'string',
    ];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, "imageable");
    }

    public function cover(): MorphOne
    {
        return $this->morphOne(Image::class, "imageable")->where("is_cover", 1);
    }

    public function stores(): BelongsToMany
    {
        return $this->belongsToMany(Store::class)
            ->using(MeatStore::class)
            ->withPivot('price', 'promo_label', 'url')
            ->withTimestamps();
    }

}
