<?php

namespace App\Livewire\Meals;

use App\Livewire\Forms\MealForm;
use App\Models\Meal;
use Livewire\Component;

class Update extends Component
{
    public Meal $meal;
    public MealForm $form;

    public function mount(Meal $meal): void
    {
        $this->meal = $meal;
        $this->form->setMeal($meal);
    }

    public function save()
    {
        $this->form->update();

        return redirect()
            ->route('meals.index')
            ->success("{$this->form->name} editada com sucesso!");
    }

    public function render()
    {
        return view('livewire.meals.update');
    }
}
