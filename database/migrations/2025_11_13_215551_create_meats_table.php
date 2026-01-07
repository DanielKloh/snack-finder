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
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Nome da refeição (ex: Feijoada, Lasanha, Churrasco)');
            $table->string('category')->comment('Categoria da refeição (ex: Carne, Massa, Vegetariano, Vegano)');
            $table->text('description')->nullable()->comment('Descrição da refeição');

            // Características de preparo
            $table->integer('preparation_time_minutes')->comment('Tempo médio de preparo (min)');
            $table->enum('difficulty', ['easy', 'medium', 'hard'])->comment('Dificuldade de preparo');

            // Perfil nutricional / sensorial simples
            $table->enum('fat_level', ['low', 'medium', 'high'])->nullable();
            $table->enum('protein_level', ['low', 'medium', 'high'])->nullable();

            // Recomendação e contexto
            $table->decimal('average_cost', 8, 2)->comment('Custo médio da refeição');
            $table->string('best_served_with')->nullable()->comment('Acompanhamentos sugeridos');
            $table->text('recommendation_notes')->nullable();

            // Contextos comuns
            $table->boolean('is_premium')->default(false);
            $table->boolean('is_for_large_group')->default(false);
            $table->boolean('is_beginner_friendly')->default(false);
            $table->boolean('is_vegetarian')->default(false);
            $table->boolean('is_vegan')->default(false);

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
