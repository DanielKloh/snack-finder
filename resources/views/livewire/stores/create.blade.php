<div>
    <div class="flex flex-row items-center justify-between w-full">
        <div>
            <flux:heading size="xl">Lojas</flux:heading>
            <flux:text class="mt-2 mb-6 text-base">Criar Loja</flux:text>
        </div>

        <flux:button :href="route('stores.index')" wire:navigate>
            Voltar
        </flux:button>
    </div>

    <x-section>
        <form wire:submit="registerStore" class="space-y-8">

            {{-- Dados principais --}}
            <div class="grid lg:grid-cols-2 gap-6">
                <flux:field>
                    <flux:input label="Nome da Loja" placeholder="Ex: Mercado Central, iFood, Restaurante X"
                        wire:model="store.name" required max="255" min="3" />
                </flux:field>

                <flux:field>
                    <flux:input label="Slug" placeholder="mercado-central" wire:model="store.slug" required
                        max="255" min="3" />
                </flux:field>
            </div>

            {{-- Contato --}}
            <div class="grid lg:grid-cols-2 gap-6">
                <flux:field>
                    <flux:input label="Website" type="url" placeholder="https://loja.com.br"
                        wire:model="store.website" max="255" />
                </flux:field>

                <flux:field>
                    <flux:input label="Telefone" type="tel" placeholder="(51) 99999-9999" wire:model="store.phone"
                        min="11" max="11" />
                </flux:field>
            </div>

            {{-- Horários --}}
            <div class="border-t pt-8">
                <h3 class="text-xl font-semibold mb-4">Horário de Funcionamento</h3>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @php
                        $days = [
                            'monday' => 'Segunda',
                            'tuesday' => 'Terça',
                            'wednesday' => 'Quarta',
                            'thursday' => 'Quinta',
                            'friday' => 'Sexta',
                            'saturday' => 'Sábado',
                            'sunday' => 'Domingo',
                        ];
                    @endphp
                    @foreach ($days as $dayKey => $dayLabel)
                        <flux:field>
                            <flux:input :label="$dayLabel" placeholder="08:00 às 18:00"
                                wire:model="store.opening_hours.{{ $dayKey }}" />
                        </flux:field>
                    @endforeach
                </div>
            </div>

            {{-- Ações --}}
            <div class="flex items-center justify-end gap-4 border-t pt-6 mt-6">
                <flux:button variant="ghost" :href="route('stores.index')" wire:navigate>
                    Cancelar
                </flux:button>

                <flux:button variant="primary" type="submit" icon="check">
                    Registrar Loja
                </flux:button>
            </div>
        </form>
    </x-section>
</div>
