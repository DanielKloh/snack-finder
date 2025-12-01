<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Meat; // Certifique-se de que o namespace está correto

class MeatSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // ... (Outras chamadas de Seeder)

        // Limpa a tabela antes de popular (Opcional, mas útil)
        Meat::truncate(); 
        
        // GERAÇÃO DOS 500 REGISTROS ALEATÓRIOS
        Meat::factory()->count(100)->create();

        $this->command->info('A tabela meats foi populada com 500 registros aleatórios!');

        // ... (Você pode adicionar a chamada do MeatSeeder com os dados fixos aqui se quiser misturar)
        // $this->call(MeatSeeder::class);
    }
}