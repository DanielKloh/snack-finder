<?php

namespace App\Livewire\Stores;

use App\Livewire\Forms\StoreForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public StoreForm $store;

    public function registerStore()
    {
        $this->store->user_id = Auth::id();

        $this->store->registerStore();

        return redirect()
            ->route('stores.index')
            ->success("Loja {$this->store->name} registrada com sucesso!");
    }

    public function render()
    {
        return view('livewire.stores.create');
    }
}
