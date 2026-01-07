<?php

namespace App\Services;

use App\Models\Meal;

class MealService
{
    public function getMeals(string $sortBy, string $sortDirection, array $filters)
    {
        $query = Meal::query();

        if (isset($filters['is_for_large_group'])) {
            $query->where('is_for_large_group', $filters['is_for_large_group']);
        }

        if (isset($filters['is_premium'])) {
            $query->where('is_premium', $filters['is_premium']);
        }

        if (isset($filters['is_beginner_friendly'])) {
            $query->where('is_beginner_friendly', $filters['is_beginner_friendly']);
        }

        if (!empty($filters['name'])) {
            $query->where('name', 'ilike', '%' . $filters['name'] . '%'); // PostgreSQL
        }

        if (!empty($filters['cut_type'])) {
            $query->where('cut_type', $filters['cut_type']);
        }

        if ($sortBy) {
            $query->orderBy($sortBy, $sortDirection);
        }

        return $query->paginate(15);
    }
}
