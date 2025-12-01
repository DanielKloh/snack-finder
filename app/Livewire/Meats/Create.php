<?php

namespace App\Livewire\Meats;

use App\Livewire\Forms\MeatForm;
use App\Models\Meat;
use Livewire\Component;

class Create extends Component
{
    public MeatForm $form;

    public function save()
    {
        try {

            $this->form->store();

            return redirect(route('meats.index'))->success("{$this->form->name} criado com sucesso!!");

        } catch (\Throwable $th) {
            // throw $th;
        }
    }

    public function render()
    {
        return view('livewire.meats.create');
    }
}
