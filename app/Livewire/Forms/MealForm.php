<?php

namespace App\Livewire\Forms;

use App\Models\Meal;
use Livewire\Form;

class MealForm extends Form
{
    public ?Meal $meal = null;

    public string $name;
    public string $category;
    public ?string $description = null;

    public int $preparation_time_minutes;
    public string $difficulty = 'easy';

    public ?string $fat_level = null;
    public ?string $protein_level = null;

    public float $average_cost;

    public ?string $best_served_with = null;
    public ?string $recommendation_notes = null;

    public bool $is_premium = false;
    public bool $is_for_large_group = false;
    public bool $is_beginner_friendly = false;
    public bool $is_vegetarian = false;
    public bool $is_vegan = false;

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',

            'preparation_time_minutes' => 'required|integer|min:1',
            'difficulty' => 'required|in:easy,medium,hard',

            'fat_level' => 'nullable|in:low,medium,high',
            'protein_level' => 'nullable|in:low,medium,high',

            'average_cost' => 'required|decimal:0,2|min:0',

            'best_served_with' => 'nullable|string|max:255',
            'recommendation_notes' => 'nullable|string',

            'is_premium' => 'boolean',
            'is_for_large_group' => 'boolean',
            'is_beginner_friendly' => 'boolean',
            'is_vegetarian' => 'boolean',
            'is_vegan' => 'boolean',
        ];
    }

    public function store(): Meal
    {
        return Meal::create($this->validate());
    }

    public function setMeal(Meal $meal): void
    {
        $this->meal = $meal;

        $this->fill($meal->toArray());
    }

    public function update(): Meal
    {
        $this->meal->update($this->validate());

        return $this->meal->fresh();
    }
}
