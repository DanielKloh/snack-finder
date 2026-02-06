<?php

namespace App\Livewire\Stores;

use App\Models\Store;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $filters = [
        'name' => null,
        'phone' => null,
        'website' => null,
    ];

    public $sortField = 'name';
    public $sortDirection = 'asc';

    protected $queryString = [
        'filters',
        'sortField',
        'sortDirection'
    ];

    public function filter()
    {
        $this->resetPage();
    }

    public function sort($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function remove($id)
    {
        Store::findOrFail($id)->delete();
    }

    public function render()
    {
        $stores = Store::query()
            ->when(
                $this->filters['name'],
                fn($q) =>
                $q->where('name', 'like', '%' . $this->filters['name'] . '%')
            )
            ->when(
                $this->filters['phone'],
                fn($q) =>
                $q->where('phone', 'like', '%' . $this->filters['phone'] . '%')
            )
            ->when(
                $this->filters['website'],
                fn($q) =>
                $q->where('website', 'like', '%' . $this->filters['website'] . '%')
            )
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.stores.index', compact('stores'));
    }
}
