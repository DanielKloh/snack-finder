<?php

namespace App\Livewire\Meats;

use App\Livewire\Forms\MeatForm;
use App\Models\Meat;
use Livewire\Component;

class Update extends Component
{
    public Meat $meat;

    public MeatForm $form;

    public function mount(Meat $meat): void
    {
        $this->meat = $meat;
        $this->form->setMeat($this->meat);
    }

    public function save()
    {
            $this->form->update();
            return redirect(route('meats.index'))->success("{$this->form->name} editada com sucesso!!");

   
    }

    public function render()
    {
        return view('livewire.meats.update');
    }
}
