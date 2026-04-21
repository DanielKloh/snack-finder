<?php

namespace App\Console\Commands;

use App\Jobs\ProcessMealJob;
use App\Models\Meal;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ImportMeals extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-meals';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $jsonPath = public_path("meals.json");

        $jsonData = json_decode(file_get_contents($jsonPath), true);

        if (!is_array($jsonData)) {
            die("Erro ao ler o json \n");
        }

        foreach ($jsonData as $meal) {
            $meal = Meal::create([
                'name' => $meal["name"],
                'category' => $meal["category"],
                'description' => $meal["description"],
                'preparation_time_minutes' => $meal["preparation_time_minutes"],
                'difficulty' => $meal["difficulty"],
                'fat_level' => $meal["fat_level"],
                'protein_level' => $meal["protein_level"],
                'average_cost' => $meal["average_cost"],
                'best_served_with' => $meal["best_served_with"],
                'recommendation_notes' => $meal["recommendation_notes"],
                'is_premium' => $meal["is_premium"],
                'is_for_large_group' => $meal["is_for_large_group"],
                'is_beginner_friendly' => $meal["is_beginner_friendly"],
                'is_vegetarian' => $meal["is_vegetarian"],
                'is_vegan' => $meal["is_vegan"],
            ]);

            dispatch(new ProcessMealJob($meal));
        }

        $this->info("Importação finalizada com sucesso!");
    }
}
