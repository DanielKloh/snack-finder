<div>
    <flux:main container="">
        <div class="flex flex-row items-center justify-between w-full">
            <div>
                <flux:heading size="xl">Refeições</flux:heading>
                <flux:text class="mt-2 mb-6 text-base">Listagem de Refeições</flux:text>
            </div>

            <flux:button href="{{ route('meals.create') }}" icon="plus-circle">
                Nova Refeição
            </flux:button>
        </div>

        <x-section>

            {{-- Filtros --}}
            <div class="grid lg:grid-cols-13 gap-4 mb-8 items-end">

                <flux:field class="col-span-3">
                    <flux:input
                        label="Nome"
                        placeholder="Buscar pelo nome da refeição"
                        wire:model="filters.name"
                    />
                </flux:field>

                <flux:field class="col-span-3">
                    <flux:select label="Categoria" wire:model.live="filters.category">
                        <flux:select.option value="">Selecione</flux:select.option>
                        <flux:select.option value="Carne">Carne</flux:select.option>
                        <flux:select.option value="Massa">Massa</flux:select.option>
                        <flux:select.option value="Vegetariano">Vegetariano</flux:select.option>
                        <flux:select.option value="Vegano">Vegano</flux:select.option>
                        <flux:select.option value="Peixe">Peixe</flux:select.option>
                        <flux:select.option value="Sobremesa">Sobremesa</flux:select.option>
                    </flux:select>
                </flux:field>

                <flux:field class="col-span-2">
                    <flux:checkbox
                        wire:model="filters.is_for_large_group"
                        label="Para grupos grandes"
                    />
                </flux:field>

                <flux:field class="col-span-2">
                    <flux:checkbox
                        wire:model="filters.is_premium"
                        label="Premium"
                    />
                </flux:field>

                <flux:field class="col-span-1">
                    <flux:button
                        wire:click="filter"
                        icon="magnifying-glass"
                        class="w-full"
                    />
                </flux:field>
            </div>

            {{-- Tabela --}}
            <x-table>
                <x-table.columns>

                    <x-table.column>Nome</x-table.column>

                    <x-table.column>
                        Gordura
                    </x-table.column>

                    <x-table.column>
                        Dificuldade
                    </x-table.column>

                    <x-table.column
                        wire:click="sort('average_cost')"
                        sortable
                        :sorted="'average_cost'"
                        :direction="$sortDirection"
                    >
                        Custo médio
                    </x-table.column>

                    <x-table.column>
                        Tempo preparo
                    </x-table.column>

                    <x-table.column>
                        Categoria
                    </x-table.column>

                    <x-table.column></x-table.column>

                    <x-table.rows>
                        @foreach ($meals as $meal)
                            <x-table.row wire:key="meal-{{ $meal->id }}">

                                <x-table.cell>
                                    {{ $meal->name }}
                                </x-table.cell>

                                <x-table.cell>
                                    {{ $meal->fat_level ?? '-' }}
                                </x-table.cell>

                                <x-table.cell>
                                    {{ ucfirst($meal->difficulty) }}
                                </x-table.cell>

                                <x-table.cell>
                                    R$ {{ number_format($meal->average_cost, 2, ',', '.') }}
                                </x-table.cell>

                                <x-table.cell>
                                    {{ $meal->preparation_time_minutes }} min
                                </x-table.cell>

                                <x-table.cell>
                                    {{ $meal->category }}
                                </x-table.cell>

                                <x-table.cell class="flex gap-2">
                                    <flux:button
                                        href="{{ route('meals.update', $meal->id) }}"
                                        variant="ghost"
                                        size="sm"
                                        icon="pencil"
                                        inset="top bottom"
                                    />

                                    <flux:button
                                        wire:confirm="Você tem certeza de que deseja excluir este registro?"
                                        wire:click="remove({{ $meal->id }})"
                                        variant="ghost"
                                        size="sm"
                                        icon="trash"
                                        inset="top bottom"
                                    />
                                </x-table.cell>

                            </x-table.row>
                        @endforeach
                    </x-table.rows>

                </x-table.columns>
            </x-table>

            {{-- Paginação --}}
            <div class="mt-6">
                {{ $meals->links() }}
            </div>

        </x-section>
    </flux:main>
</div>
