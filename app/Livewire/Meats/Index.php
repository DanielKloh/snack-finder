<?php

namespace App\Livewire\Meats;

use App\Models\Meat;
use App\Services\MeatService;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class Index extends Component
{
    use WithPagination;

    public string $sortBy = '';

    public string $sortDirection = 'desc';

    protected MeatService $meatService;

    public array $filters = [];

    public function boot(MeatService $meatService)
    {
        $this->meatService = $meatService;
    }

    public function sort($sortBy)
    {
        $this->sortBy = $sortBy;
        $this->sortDirection = ! empty($this->sortDirection)
                        && $this->sortDirection === 'asc' ? 'desc' : 'asc';
        $this->resetPage();
    }

    public function filter()
    {
        $this->validate([
            'filters.name' => 'nullable|string|min:3|max:255',
            'filters.cut_type' => 'nullable',
            'filters.is_for_large_group' => 'sometimes|boolean',
            'filters.is_premium' => 'sometimes|boolean',
            'filters.is_beginner_friendly' => 'sometimes|boolean',
        ]);

        $this->resetPage();
    }

    public function remove(Meat $meat)
    {

        $meat->delete();
        Toaster::success("{$meat->name} deletado bb");
    }

    public function render()
    {
        return view('livewire.meats.index', [
            'meats' => $this->meatService->getMeats($this->sortBy, $this->sortDirection, $this->filters),
        ]);
    }
}
