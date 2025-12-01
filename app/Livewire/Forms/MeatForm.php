<?php

namespace App\Livewire\Forms;

use App\Models\Meat;
use Livewire\Form;
use Masmerise\Toaster\Toaster;
use Masmerise\Toaster\ToasterServiceProvider;

class MeatForm extends Form
{
    public ?Meat $meat;

    public string $name;

    public string $cut_type;

    public string $description;

    public string $fat_level = 'low';

    public int $cooking_time_minutes;

    public string $difficulty = 'easy';

    public float $cost_per_kg_approx;

    public string $best_served_with;

    public string $recommendation_notes;

    public bool $is_premium = false;

    public bool $is_for_large_group = false;

    public bool $is_beginner_friendly = false;

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'cut_type' => 'required|in:Bovino,Frango,Ovino,Pescado',
            'description' => 'required|string|min:3|max:255',
            'fat_level' => 'required|in:low,medium,high',
            'cooking_time_minutes' => 'required',
            'difficulty' => 'required|in:easy,medium,hard',
            'cost_per_kg_approx' => 'required|decimal:0,2|min:0',
            'best_served_with' => 'required|string|min:3|max:2000',
            'recommendation_notes' => 'required|string|min:3|max:2000',
            'is_premium' => 'required|boolean',
            'is_for_large_group' => 'required|boolean',
            'is_beginner_friendly' => 'required|boolean',
        ];
    }

    public function store(): Meat
    {
        return Meat::create($this->validate());
    }

    public function setMeat(Meat $meat): void
    {
        $this->meat = $meat;
        $this->name = $meat->name;
        $this->cut_type = $meat->cut_type;
        $this->description = $meat->description;
        $this->fat_level = $meat->fat_level;
        $this->cooking_time_minutes = $meat->cooking_time_minutes;
        $this->difficulty = $meat->difficulty;
        $this->cost_per_kg_approx = $meat->cost_per_kg_approx;
        $this->best_served_with = $meat->best_served_with;
        $this->recommendation_notes = $meat->recommendation_notes;
        $this->is_premium = $meat->is_premium;
        $this->is_for_large_group = $meat->is_for_large_group;
        $this->is_beginner_friendly = $meat->is_beginner_friendly;
    }

    public function update(): Meat
    {
        $this->meat->update($this->validate());

        return $this->meat->fresh();
    }

}
