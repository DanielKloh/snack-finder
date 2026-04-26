<?php

namespace App\Livewire\Chat;

use App\Services\MealFinderService;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Chat extends Component
{
    #[Validate('required|string|min:3')]
    public string $message = '';

    public array $messages = [];

    public bool $isLoading = false;

    protected MealFinderService $mealFinder;

    public function boot(MealFinderService $mealFinder)
    {
        $this->mealFinder = $mealFinder;
    }

    public function sendMessage(): void
    {
        $this->validate();

        // Adiciona a mensagem do usuário
        $this->messages[] = [
            'type' => 'user',
            'content' => $this->message,
            'timestamp' => now(),
        ];

        // Simula processamento
        $this->isLoading = true;

        // Gera resposta simulada

        $this->dispatch('generate-response');

    }

    #[On('generate-response')]
    public function generateResponse(): void
    {
        $result = $this->mealFinder->agent($this->message);

        $this->messages[] = [
            'type' => 'bot',
            'content' => $result['text'],
            'meals' => $result['meals'] ?? [],
            'timestamp' => now(),
        ];

        $this->isLoading = false;
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.chat.chat');
    }
}
