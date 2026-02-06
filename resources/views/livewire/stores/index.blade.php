<div>
    <flux:main container="">
        <div class="flex flex-row items-center justify-between w-full">
            <div>
                <flux:heading size="xl">Lojas</flux:heading>
                <flux:text class="mt-2 mb-6 text-base">
                    Listagem de Lojas
                </flux:text>
            </div>

            <flux:button href="{{ route('stores.create') }}" icon="plus-circle">
                Nova Loja
            </flux:button>
        </div>

        <x-section>

            {{-- Filtros --}}
            <div class="grid lg:grid-cols-12 gap-4 mb-8 items-end">

                <flux:field class="col-span-4">
                    <flux:input label="Nome" placeholder="Buscar pelo nome da loja" wire:model.defer="filters.name" />
                </flux:field>

                <flux:field class="col-span-3">
                    <flux:input label="Telefone" placeholder="Buscar por telefone" wire:model.defer="filters.phone" />
                </flux:field>

                <flux:field class="col-span-4">
                    <flux:input label="Website" placeholder="Buscar por website" wire:model.defer="filters.website" />
                </flux:field>

                <flux:field class="col-span-1">
                    <flux:button wire:click="filter" icon="magnifying-glass" class="w-full" />
                </flux:field>
            </div>

            {{-- Tabela --}}
            <x-table>
                <x-table.columns>

                    <x-table.column wire:click="sort('name')" sortable :sorted="'name'" :direction="$sortDirection">
                        Nome
                    </x-table.column>

                    <x-table.column>
                        Slug
                    </x-table.column>

                    <x-table.column>
                        Telefone
                    </x-table.column>

                    <x-table.column>
                        Website
                    </x-table.column>

                    <x-table.column>
                        Horário de Funcionamento
                    </x-table.column>

                    <x-table.column></x-table.column>

                    <x-table.rows>
                        @foreach ($stores as $store)
                            <x-table.row wire:key="store-{{ $store->id }}">

                                <x-table.cell>
                                    {{ $store->name }}
                                </x-table.cell>

                                <x-table.cell>
                                    {{ $store->slug }}
                                </x-table.cell>

                                <x-table.cell>
                                    {{ $store->phone ?? '-' }}
                                </x-table.cell>

                                <x-table.cell>
                                    @if ($store->website)
                                        <a href="{{ $store->website }}" target="_blank" class="text-primary underline">
                                            {{ $store->website }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </x-table.cell>

                                <x-table.cell>
                                    {{ $store->opening_hours ?? '-' }}
                                </x-table.cell>

                                <x-table.cell class="flex gap-2">
                                    <flux:button href="{{ route('stores.edit', $store->id) }}" variant="ghost"
                                        size="sm" icon="pencil" inset="top bottom" />

                                    <flux:button wire:confirm="Você tem certeza que deseja excluir esta loja?"
                                        wire:click="remove({{ $store->id }})" variant="ghost" size="sm"
                                        icon="trash" inset="top bottom" />
                                </x-table.cell>

                            </x-table.row>
                        @endforeach
                    </x-table.rows>

                </x-table.columns>
            </x-table>

            {{-- Paginação --}}
            <div class="mt-6">
                {{ $stores->links() }}
            </div>

        </x-section>
    </flux:main>
</div>
