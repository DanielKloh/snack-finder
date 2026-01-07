<?php

namespace App\Livewire\Meals;

use App\Models\Meal;
use App\Services\MealService;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class Index extends Component
{
    use WithPagination;

    public string $sortBy = '';
    public string $sortDirection = 'desc';

    public array $filters = [];

    protected MealService $mealService;

    public function boot(MealService $mealService)
    {
        $this->mealService = $mealService;
    }

    public function sort($sortBy)
    {
        $this->sortBy = $sortBy;
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        $this->resetPage();
    }

    public function filter()
    {
        $this->filters = array_merge([
            'is_for_large_group' => false,
            'is_premium' => false,
            'is_beginner_friendly' => false,
        ], $this->filters);

        $this->validate([
            'filters.name' => 'nullable|string|min:3|max:255',
            'filters.cut_type' => 'nullable|string',
            'filters.is_for_large_group' => 'boolean',
            'filters.is_premium' => 'boolean',
            'filters.is_beginner_friendly' => 'boolean',
        ]);

        $this->resetPage();
    }

    public function remove($id)
    {
        Meal::findOrFail($id)->delete();
        Toaster::success('Receita deletada com sucesso');
    }

    public function render()
    {
        return view('livewire.meals.index', [
            'meals' => $this->mealService->getMeals(
                $this->sortBy,
                $this->sortDirection,
                $this->filters
            ),
        ]);
    }
}
