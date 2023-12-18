<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex gap-x-4">
            <div class="p-4 border rounded-lg">
                <h3 class="text-lg">Set Active Agents to Unpaid/Unterminated Invoice</h3>
                <button wire:click="randomize" 
                wire:loading.attr="disabled"
                wire:loading.class="text-yellow-500"
                class="mt-2 p-2 rounded border border-primary">Randomize<span wire:loading>...</span></button>
            </div>
            <div>
                <h3 class="text-lg">Today, {{ $currentDate }}</h3>
                <p class="font-bold">Invoices : {{ $invoices }}</p>
                <p class="font-bold">Agents : {{ $agents }}</p>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
