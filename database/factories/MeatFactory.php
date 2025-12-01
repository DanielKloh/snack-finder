<?php

namespace Database\Factories;

use App\Models\Meat;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeatFactory extends Factory
{
    /**
     * O modelo associado à factory.
     *
     * @var string
     */
    protected $model = Meat::class;

    /**
     * Define o estado padrão do modelo.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Valores base para ENUMS
        $fatLevels = ['low', 'medium', 'high'];
        $tendernessLevels = ['low', 'medium', 'high'];
        $difficulties = ['easy', 'medium', 'hard'];
        $cutTypes = ['Bovino', 'Suíno', 'Frango', 'Ovino', 'Pescado'];

        return [
            // Dados de Identificação
            'name' => $this->faker->unique()->word() . ' ' . $this->faker->numerify('Corte-####'),
            'cut_type' => $this->faker->randomElement($cutTypes),
            'description' => $this->faker->sentence(10),
            
            // Características Físicas e de Preparo (ENUMS e Números)
            'fat_level' => $this->faker->randomElement($fatLevels),
            'cooking_time_minutes' => $this->faker->numberBetween(10, 180), // De 10 min a 3 horas
            'difficulty' => $this->faker->randomElement($difficulties),
            
            // Foco na Recomendação (Custo e Tags)
            'cost_per_kg_approx' => $this->faker->randomFloat(2, 20, 250), // Preço entre R$ 20,00 e R$ 250,00
            'best_served_with' => $this->faker->sentence(4),
            'recommendation_notes' => $this->faker->paragraph(3),

            // Tags booleanas (Aleatório 50/50)
            'is_premium' => $this->faker->boolean(30), // 30% de chance de ser premium
            'is_for_large_group' => $this->faker->boolean(70), // 70% de chance de ser para grupo grande
            'is_beginner_friendly' => $this->faker->boolean(80), // 80% de chance de ser fácil
        ];
    }
}