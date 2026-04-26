<?php

namespace App\Livewire\Meals;

use App\Jobs\ProcessMealJob;
use App\Livewire\Forms\MealForm;
use App\Models\Meal;
use Livewire\Component;

class Create extends Component
{
    public MealForm $form;

    public function save()
    {

        $this->authorize('create', Meal::class);

        try {
            $meal = $this->form->store();

            dispatch(new ProcessMealJob($meal));

            return redirect()
                ->route('meals.index')
                ->success("{$this->form->name} criada com sucesso!");
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function render()
    {
        return view('livewire.meals.create');
    }
}
