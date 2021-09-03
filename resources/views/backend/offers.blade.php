<x-backend.layout>
    <header class="flex justify-between mb-5 items-center">
        <div>
            <h1 class="text-3xl font-bold">Offers</h1>
        </div>
    </header>

    <hr />

    <div x-data="{ open: 'traditional' }" class="mt-2">

        <div class="flex">
            <x-button-tab type="button" tab="traditional" />
            <x-button-tab type="button" tab="auction" />
        </div>

        <div x-show="open == 'traditional'">
            <livewire:show-offers type="traditional" :countries="$countries" :wire:key="traditional"/>
        </div>

        <div x-show="open == 'auction'">
            <livewire:show-offers type="auction" :countries="$countries" :wire:key="auction"/>
        </div>
    </div>
</x-backend.layout>
