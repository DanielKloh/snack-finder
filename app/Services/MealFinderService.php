<?php

namespace App\Services;

use Prism\Prism\Enums\Provider;
use Prism\Prism\Enums\ToolChoice;
use Prism\Prism\Facades\Prism;
use Prism\Prism\Facades\Tool;
use Prism\Prism\Schema\ArraySchema;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\StringSchema;

class MealFinderService
{
    public function __construct(protected EmbeddingService $embeddingService) {}

    public function agent(string $userMessage): array
    {
        try {
            $schema = $this->responseSchema();

            $response = Prism::structured()
                ->using(Provider::OpenAI, 'gpt-4.1-mini')
                ->withSchema($schema)
                ->withSystemPrompt(view('prompts.brewer_agent'))
                ->withPrompt($userMessage)
                ->withMaxSteps(5)
                ->withTools([
                    Tool::as('search_meals')
                        ->for('Buscar refeições relevantes com base em uma descrição, estilo, sabor ou harmonização desejada.')
                        ->withStringParameter(
                            'query',
                            'Descrição da refeição, preferências de sabor ou contexto de harmonização fornecido pelo usuário'
                        )
                        ->using(fn ($query) => $this->embeddingService->queryEmbeddingMeals($query)),
                ])
                ->withToolChoice(ToolChoice::Auto)
                ->asStructured();
        } catch (\Exception $e) {
            return [
                'text' => 'Ocorreu um erro ao gerar a resposta',
                'meals' => [],
            ];
        }

        return $response->structured;
    }

    public function responseSchema()
    {
        $mealItemSchema = new ObjectSchema(
            name: 'meal_item',
            description: 'Item individual de refeição recomendada pelo sistema',
            properties: [
                new StringSchema(
                    'nome',
                    'Nome da refeição recomendada'
                ),
                new StringSchema(
                    'imagem',
                    'URL da imagem da refeição (pode ser vazio se não houver)'
                ),
                new StringSchema(
                    'url',
                    'URL de compra ou página de detalhes da refeição (pode ser vazio se não houver)'
                ),
                new StringSchema(
                    'preco',
                    'Preço da refeição em texto, ex: "R$ 4,99" (pode ser vazio se não houver)'
                ),
            ],
            requiredFields: ['nome', 'imagem', 'url', 'preco']
        );

        $schema = new ObjectSchema(
            name: 'meal_finder_response',
            description: 'Resposta estruturada do Beer Finder Agent',
            properties: [
                new StringSchema(
                    'text',
                    'Texto descritivo curto explicando por que essas refeições foram recomendadas'
                ),
                new ArraySchema(
                    'meals',
                    'Lista de refeições recomendadas com base na busca vetorial',
                    $mealItemSchema
                ),
            ],
            requiredFields: ['text', 'meals']
        );

        return $schema;
    }
}
