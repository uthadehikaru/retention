<x-filament-panels::page>
    <form wire:submit="submit">
        <div class="relative mb-4">
            <label for="file" class="leading-7 text-sm text-gray-600">File</label>
            <input type="file" id="file" name="file" wire:model="file"
            wire:loading.attr="disabled"
            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
        </div>
        <div class="relative mb-4">
            <button class="p-2 rounded bg-primary-600 text-white hover:bg-primary-400" type="submit"
            wire:loading.attr="disabled" wire:loading.class="bg-primary-400"
            >Upload<span wire:loading wire:target="submit">ing...</span></button>
        </div>
    </form>
</x-filament-panels::page>
