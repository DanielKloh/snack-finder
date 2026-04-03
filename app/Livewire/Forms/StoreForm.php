<?php

namespace App\Livewire\Forms;

use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StoreForm extends Form
{
    public ?Store $store = null;

    public int $id;
    public string $name;
    public string $slug;
    public string $website;
    public string $phone;
    public array $opening_hours;
    public int $user_id;


    public function rules(): array
    {
        return [
            'user_id' => 'required|integer',
            'name' => 'required|string|min:3|max:255',
            'slug' => 'required|string|min:3|max:255',
            'website' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:11|min:11',
            'opening_hours' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome da loja é obrigatório.',
            'name.string' => 'O nome da loja deve ser um texto.',
            'name.min' => 'O nome da loja deve ter pelo menos 3 caracteres.',
            'name.max' => 'O nome da loja deve ter no máximo 255 caracteres.',

            'slug.required' => 'O slug é obrigatório.',
            'slug.string' => 'O slug deve ser um texto.',
            'slug.max' => 'O slug deve ter no máximo 255 caracteres.',

            'website.string' => 'O site deve ser um texto.',
            'website.max' => 'O site deve ter no máximo 255 caracteres.',

            'phone.string' => 'O telefone deve ser um texto.',
            'phone.min' => 'O telefone deve ter 11 dígitos.',
            'phone.max' => 'O telefone deve ter 11 dígitos.',

            'opening_hours.required' => 'O horário de funcionamento é obrigatório.',
        ];
    }


    public function registerStore(): void
    {
        Store::create($this->validate());
    }

    public function setStore(Store $store): void
    {
        $this->store = $store;

        $this->fill($store->toArray());
    }

    public function update():void
    {
        $this->store->update($this->validate());
    }
}
