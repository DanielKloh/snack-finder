<div>
    <div class="flex flex-row items-center justify-between w-full">
        <div>
            <flux:heading size="xl">Lojas</flux:heading>
            <flux:text class="mt-2 mb-6 text-base">Editar Loja</flux:text>
        </div>

        <flux:button :href="route('stores.index')" wire:navigate>
            Voltar
        </flux:button>
    </div>

    <x-section>
        <form wire:submit="save" class="space-y-8">

            {{-- Dados principais --}}
            <div class="grid lg:grid-cols-2 gap-6">
                <flux:field>
                    <flux:input label="Nome da Loja" placeholder="Ex: Mercado Central, iFood, Restaurante X"
                        wire:model="form.name" required />
                </flux:field>

                <flux:field>
                    <flux:input label="Slug" placeholder="mercado-central" wire:model="form.slug" required />
                </flux:field>
            </div>

            {{-- Contato --}}
            <div class="grid lg:grid-cols-2 gap-6">
                <flux:field>
                    <flux:input label="Website" type="url" placeholder="https://loja.com.br"
                        wire:model="form.website" />
                </flux:field>

                <flux:field>
                    <flux:input label="Telefone" placeholder="(51) 99999-9999" wire:model="form.phone" />
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
                                wire:model="form.opening_hours.{{ $dayKey }}" />
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
                    Salvar alterações
                </flux:button>
            </div>
        </form>
    </x-section>
</div>
