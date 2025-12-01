<?php

namespace App\Services;

use App\Models\Meat;

class MeatService
{
    public function getMeats(string $sortBy, string $sortDirection, array $filters)
    {
        $query = Meat::query();

        if(isset($filters['is_for_large_group'])){
            $query->where('is_for_large_group', $filters['is_for_large_group']);
        }
        if(isset($filters['is_premium'])){
            $query->where('is_for_large_group', $filters['is_premium']);
        }

        if (isset($filters['name'])) {
            $query->where('name', 'like', '%'.$filters['name'].'%');
        }

        if (isset($filters['cut_type'])) {
            $query->where('cut_type', $filters['cut_type']);
        }

        if ($sortBy && $sortDirection) {
            $query->orderBy($sortBy, $sortDirection);
        }

        return $query->paginate(15);
    }
}
