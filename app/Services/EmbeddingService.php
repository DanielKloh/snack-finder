<?php

namespace App\Services;

use App\Models\Beer;
use App\Models\Meal;
use Illuminate\Support\Facades\DB;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Facades\Prism;

class EmbeddingService
{

    public function generateEmbedding(string $text)
    {
        $response = Prism::embeddings()
            ->using(Provider::OpenAI, 'text-embedding-3-small')
            ->fromInput($text)
            ->asEmbeddings();

        return $response;

    }

    public function queryEmbeddingMeals(string $query)
    {

        $response = $this->generateEmbedding($query);

        $vectorLiteral = '[' . implode(',', $response->embeddings[0]->embedding) . ']';

        $results = DB::table('meal_embeddings')
            ->select(
                'meal_id',
                'text',
                DB::raw("embedding <#> '$vectorLiteral' AS distance")
            )->orderBy('distance')
            ->limit(5)
            ->get();

        $meal_ids = $results->map(fn ($meal) => json_decode($meal->meal_id));

        $meals = Meal::with('stores', 'images')
            ->findMany($meal_ids)
            ->sortBy(function ($meal) use ($meal_ids) {
                return array_search($meal->id, $meal_ids->toArray());
            })->values();

        return $meals->toJson(JSON_UNESCAPED_UNICODE);


    }

}