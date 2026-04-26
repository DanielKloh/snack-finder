<?php

namespace App\Livewire\Stores;

use App\Livewire\Forms\StoreForm;
use App\Models\Store;
use Livewire\Component;

class Update extends Component
{
    public Store $store;

    public StoreForm $form;

    public function mount(Store $store): void
    {
        $this->store = $store;
        $this->form->setStore($store);
    }

    public function save()
    {
        $this->form->update();

        return redirect()
            ->route('stores.index')
            ->success("Loja {$this->form->name} editada com sucesso!");
    }

    public function render()
    {
        return view('livewire.stores.update');
    }
}
