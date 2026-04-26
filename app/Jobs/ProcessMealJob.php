<?php

namespace App\Jobs;

use App\Models\Meal;
use App\Models\MealEmbedding;
use App\Services\EmbeddingService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Facades\Prism;

class ProcessMealJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Meal $meal)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(EmbeddingService $embeddingService): void
    {

        $response = Prism::text()->using(Provider::OpenAI, 'gpt-4.1-mini')->withSystemPrompt(view('prompts.brewer_tips_agent'))
            ->withPrompt($this->meal->toJson())->withClientOptions(['timeout' => 999])->asText();

        $embedding = $embeddingService->generateEmbedding($response->text);

        $meal = MealEmbedding::where('meal_id', $this->meal->id)->get();

        if ($meal) {
            MealEmbedding::where('meal_id', $this->meal->id)->delete();
        }

        MealEmbedding::create([
            'meal_id' => $this->meal->id,
            'text' => $response->text,
            'metadata' => $this->meal->toArray(),
            'embedding' => $embedding->embeddings[0]->embedding,
        ]);
    }
}
