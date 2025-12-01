<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meats', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique()->comment('Nome da carne (ex: Picanha, Fraldinha, Contrafilé)');
        $table->string('cut_type')->comment('Tipo de corte (ex: Bovino, Suíno, Frango, Ovino)');
        $table->text('description')->nullable()->comment('Descrição curta sobre o corte e sabor');
        
        // Características Físicas e de Preparo
        $table->enum('fat_level', ['low', 'medium', 'high'])->comment('Nível de gordura (baixo, médio, alto)');
        $table->integer('cooking_time_minutes')->comment('Tempo médio de preparo na brasa (em minutos)');
        $table->enum('difficulty', ['easy', 'medium', 'hard'])->comment('Dificuldade de preparo (para o churrasqueiro)');
        
        // Foco na Recomendação (Ocasião e Custo)
        $table->decimal('cost_per_kg_approx', 8, 2)->comment('Custo aproximado por kg para filtragem de orçamento');
        $table->string('best_served_with')->nullable()->comment('Acompanhamentos ideais (ex: Farofa, Vinagrete)');
        $table->text('recommendation_notes')->nullable()->comment('Dicas do churrasqueiro e melhor ponto');

        // Para Recomendações em Ocasiões Específicas
        // (Isso seria melhor com uma tabela de relacionamento, mas podemos começar com tags)
        $table->boolean('is_premium')->default(false)->comment('Indicador para ocasiões especiais/gourmet');
        $table->boolean('is_for_large_group')->default(false)->comment('Adequada para grandes grupos (ex: costelão, cortes grandes)');
        $table->boolean('is_beginner_friendly')->default(false)->comment('Fácil de acertar o ponto para iniciantes');
        
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meats');
    }
};
