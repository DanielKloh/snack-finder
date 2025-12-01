<div>
    <div class="flex flex-row items-center justify-between w-full">
        <div>
            <flux:heading size="xl">Receitas</flux:heading>
            <flux:text class="mt-2 mb-6 text-base">Atualizar Recitas</flux:text>
        </div>

        <flux:button>Voltar</flux:button>
    </div>

    <x-section>

        <form wire:submit="save" class="space-y-8">

            <div class="grid lg:grid-cols-2 gap-6">
                <flux:field>
                    <flux:input label="Nome do Corte" placeholder="Ex: Picanha, Fraldinha, Filé de Frango"
                        wire:model="form.name" required />
                </flux:field>

                <flux:field>
                    <flux:select label="Tipo do Corte" wire:model="form.cut_type">
                        <flux:select.option value="">-- Selecione o Tipo --</flux:select.option>
                        <flux:select.option value="Bovino">Bovino</flux:select.option>
                        <flux:select.option value="Frango">Frango</flux:select.option>
                        <flux:select.option value="Ovino">Ovino</flux:select.option>
                        <flux:select.option value="Pescado">Pescado</flux:select.option>
                    </flux:select>
                </flux:field>
            </div>

            <flux:field>
                <flux:textarea label="Descrição Detalhada"
                    placeholder="Conte sobre o corte, textura e características principais."
                    wire:model="form.description" rows="4" required />
            </flux:field>


            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

                <flux:field>
                    <flux:select label="Nível de Gordura" wire:model="form.fat_level">
                        <flux:select.option selected value="low">Baixo</flux:select.option>
                        <flux:select.option value="medium">Médio</flux:select.option>
                        <flux:select.option value="high">Alto</flux:select.option>
                    </flux:select>
                </flux:field>

                <flux:field>
                    <flux:input label="Tempo de Preparo (min)" type="number" min="1" max="999"
                        placeholder="30" wire:model="form.cooking_time_minutes" required />
                </flux:field>


                <flux:field>
                    <flux:select label="Dificuldade de Preparo" wire:model="form.difficulty">
                        <flux:select.option selected value="easy">Fácil</flux:select.option>
                        <flux:select.option value="medium">Médio</flux:select.option>
                        <flux:select.option value="hard">Difícil</flux:select.option>
                    </flux:select>
                </flux:field>

                <flux:field>
                    <flux:input label="Valor Estimado (R$/kg)" type="number" step="0.01" min="0"
                        max="1000" placeholder="0.00" wire:model="form.cost_per_kg_approx" required />
                </flux:field>
            </div>

            <div class="grid lg:grid-cols-2 gap-6 pt-2">
                <flux:field>
                    <flux:textarea label="Acompanhamentos Ideais" rows="2"
                        placeholder="Ex: Farofa, pão de alho, vinagrete, mandioca."
                        wire:model="form.best_served_with" />
                </flux:field>

                <flux:field>
                    <flux:textarea label="Dicas do Churrasqueiro e Ponto"
                        placeholder="Ex: Selar 3 minutos de cada lado para ponto mal-passado."
                        wire:model="form.recommendation_notes" rows="2" />
                </flux:field>
            </div>

            <div class="border-t pt-8 mt-6 border-b pb-8">
                <h3 class="text-xl font-semibold  mb-4">Classificação e Uso</h3>
                <div class="grid md:grid-cols-3 gap-6">

                    <flux:field>
                        <flux:checkbox label="Corte Premium" description="Indicador para ocasiões especiais/gourmet"
                            wire:model="form.is_premium" />
                    </flux:field>

                    <flux:field>
                        <flux:checkbox label="Para Grandes Eventos"
                            description="Ideal para churrascos ou eventos com grande número de pessoas."
                            wire:model="form.is_for_large_group" />
                    </flux:field>

                    <flux:field>
                        <flux:checkbox label="Amigável para Iniciantes" default="tru"
                            description="Fácil de preparar, com margem de erro maior no ponto da carne."
                            wire:model="form.is_beginner_friendly" />
                    </flux:field>
                </div>
            </div>

            <livewire:components.image-uploader :model="$meat ?? null" storage-path="meats" />

            <div class="flex items-center justify-end gap-4 pt-6 mt-6">
                <flux:button variant="ghost" :href="route('meats.index')" wire:navigate>
                    Cancelar
                </flux:button>
                <flux:button variant="primary" type="submit" icon="check">
                    Atualizar Receita
                </flux:button>
            </div>
        
        </form>
    </x-section>


</div>
