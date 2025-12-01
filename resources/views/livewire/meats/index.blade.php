<div>
    <flux:main container="">
        <div class="flex flex-row items-center justify-between w-full">
            <div>
                <flux:heading size="xl">Receitas</flux:heading>
                <flux:text class="mt-2 mb-6 text-base">Listagem de Recitas</flux:text>
            </div>

            <flux:button href="{{ route('meats.create') }}" icon="plus-circle">Nova Recita</flux:button>

        </div>

        <x-section>

            <div class="grid lg:grid-cols-13 gap-4 mb-8 items-end">

                <flux:field class="col-span-3">
                    <flux:input label="Nome" placeholder="Busque pelo nome da carne" wire:model="filters.name" />
                </flux:field>


                <flux:field class="col-span-3">
                    <flux:select label="Tipo do corte" wire:model.live="filters.cut_type">
                        <flux:select.option value="">Selecione</flux:select.option>
                        <flux:select.option value="Bovino">Bovino</flux:select.option>
                        <flux:select.option value="Frango">Frango</flux:select.option>
                        <flux:select.option value="Ovino">Ovino</flux:select.option>
                        <flux:select.option value="Pescado">Pescado</flux:select.option>
                    </flux:select>
                </flux:field>


                <flux:field class="col-span-2">
                    <flux:checkbox wire:model="filters.is_for_large_group" label="Adequada para grandes grupos" />
                </flux:field>

                <flux:field class="col-span-2">
                    <flux:checkbox wire:model="filters.is_premium" label="Indicador para ocasiões especiais/gourmet" />
                </flux:field>


                <flux:field class="col-span-1">
                    <flux:button wire:click="filter" icon="magnifying-glass" class="w-full"></flux:button>
                </flux:field>

            </div>

            <x-table>

                <x-table.columns>

                    <x-table.column>Nome</x-table.column>

                    <x-table.column>
                        Nível de gordura
                    </x-table.column>

                    <x-table.column>
                        Dificuldade
                    </x-table.column>

                    <x-table.column wire:click="sort('cost_per_kg_approx')" sortable :sorted="'cost_per_kg_approx'"
                        :direction="$sortDirection">
                        Valor estimado
                    </x-table.column>

                    <x-table.column>
                        Tempo de preparo
                    </x-table.column>

                    <x-table.column>
                        Tipo do corte
                    </x-table.column>

                    <x-table.column></x-table.column>



                    <x-table.rows>

                        @foreach ($meats as $meat)
                            <x-table.row wire:key="banana">
                                <x-table.cell>
                                    {{ $meat->name }}
                                </x-table.cell>
                                <x-table.cell>
                                    {{ $meat->fat_level }}
                                </x-table.cell>
                                <x-table.cell>{{ $meat->difficulty }}</x-table.cell>
                                <x-table.cell>{{ $meat->cost_per_kg_approx }} </x-table.cell>
                                <x-table.cell>{{ $meat->cooking_time_minutes }}</x-table.cell>
                                <x-table.cell>{{ $meat->cut_type }}</x-table.cell>
                                <x-table.cell>

                                    <flux:button href="{{ route('meats.update', $meat->id) }}" variant="ghost"
                                        size="sm" icon="pencil" class="cursor-pointer" inset="top bottom">
                                    </flux:button>

                                    <flux:button wire:click="remove({{ $meat->id }})" variant="ghost" size="sm"
                                        icon="trash" class="cursor-pointer" inset="top bottom"></flux:button>

                                </x-table.cell>

                            </x-table.row>
                        @endforeach

                    </x-table.rows>

                </x-table.columns>

            </x-table>

            <div class="mt-6">
                {{ $meats->links() }}
            </div>

        </x-section>

    </flux:main>

</div>
