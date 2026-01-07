<div>
    <div class="flex flex-row items-center justify-between w-full">
        <div>
            <flux:heading size="xl">Refeições</flux:heading>
            <flux:text class="mt-2 mb-6 text-base">Atualizar Refeição</flux:text>
        </div>

        <flux:button :href="route('meals.index')" wire:navigate>Voltar</flux:button>
    </div>

    <x-section>
        <form wire:submit="save" class="space-y-8">

            {{-- Nome + Categoria --}}
            <div class="grid lg:grid-cols-2 gap-6">
                <flux:field>
                    <flux:input
                        label="Nome da Refeição"
                        placeholder="Ex: Feijoada, Lasanha, Churrasco"
                        wire:model="form.name"
                        required
                    />
                </flux:field>

                <flux:field>
                    <flux:select label="Categoria" wire:model="form.category">
                        <flux:select.option value="">-- Selecione --</flux:select.option>
                        <flux:select.option value="Carne">Carne</flux:select.option>
                        <flux:select.option value="Massa">Massa</flux:select.option>
                        <flux:select.option value="Vegetariano">Vegetariano</flux:select.option>
                        <flux:select.option value="Vegano">Vegano</flux:select.option>
                        <flux:select.option value="Peixe">Peixe</flux:select.option>
                        <flux:select.option value="Sobremesa">Sobremesa</flux:select.option>
                    </flux:select>
                </flux:field>
            </div>

            {{-- Descrição --}}
            <flux:field>
                <flux:textarea
                    label="Descrição"
                    placeholder="Descreva a refeição, sabor e contexto ideal."
                    wire:model="form.description"
                    rows="4"
                />
            </flux:field>

            {{-- Preparo --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

                <flux:field>
                    <flux:select label="Nível de Gordura" wire:model="form.fat_level">
                        <flux:select.option value="">-- Opcional --</flux:select.option>
                        <flux:select.option value="low">Baixo</flux:select.option>
                        <flux:select.option value="medium">Médio</flux:select.option>
                        <flux:select.option value="high">Alto</flux:select.option>
                    </flux:select>
                </flux:field>

                <flux:field>
                    <flux:input
                        label="Tempo de Preparo (min)"
                        type="number"
                        min="1"
                        max="999"
                        wire:model="form.preparation_time_minutes"
                        required
                    />
                </flux:field>

                <flux:field>
                    <flux:select label="Dificuldade" wire:model="form.difficulty">
                        <flux:select.option value="easy">Fácil</flux:select.option>
                        <flux:select.option value="medium">Médio</flux:select.option>
                        <flux:select.option value="hard">Difícil</flux:select.option>
                    </flux:select>
                </flux:field>

                <flux:field>
                    <flux:input
                        label="Custo Médio (R$)"
                        type="number"
                        step="0.01"
                        min="0"
                        wire:model="form.average_cost"
                        required
                    />
                </flux:field>
            </div>

            {{-- Acompanhamentos / Dicas --}}
            <div class="grid lg:grid-cols-2 gap-6 pt-2">
                <flux:field>
                    <flux:textarea
                        label="Acompanhamentos"
                        rows="2"
                        wire:model="form.best_served_with"
                    />
                </flux:field>

                <flux:field>
                    <flux:textarea
                        label="Observações e Dicas"
                        rows="2"
                        wire:model="form.recommendation_notes"
                    />
                </flux:field>
            </div>

            {{-- Classificação --}}
            <div class="border-t pt-8 mt-6 border-b pb-8">
                <h3 class="text-xl font-semibold mb-4">Classificação</h3>

                <div class="grid md:grid-cols-3 gap-6">
                    <flux:field>
                        <flux:checkbox
                            label="Premium"
                            wire:model="form.is_premium"
                        />
                    </flux:field>

                    <flux:field>
                        <flux:checkbox
                            label="Para grupos grandes"
                            wire:model="form.is_for_large_group"
                        />
                    </flux:field>

                    <flux:field>
                        <flux:checkbox
                            label="Fácil de preparar"
                            wire:model="form.is_beginner_friendly"
                        />
                    </flux:field>
                </div>
            </div>

            {{-- Upload de imagens --}}
            <livewire:components.image-uploader
                :model="$meal ?? null"
                storage-path="meals"
            />

            {{-- Ações --}}
            <div class="flex items-center justify-end gap-4 pt-6 mt-6">
                <flux:button
                    variant="ghost"
                    :href="route('meals.index')"
                    wire:navigate
                >
                    Cancelar
                </flux:button>

                <flux:button variant="primary" type="submit" icon="check">
                    Atualizar Refeição
                </flux:button>
            </div>
        </form>
    </x-section>
</div>
