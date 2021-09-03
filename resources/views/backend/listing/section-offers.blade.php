<x-backend.section title="Offers">
    <div x-data="{ open: 'traditional' }">
        <div class="flex">
            <x-button-tab type="button" tab="traditional" />
            <x-button-tab type="button" tab="auction" />
        </div>

        <div x-show="open == 'traditional'">
            <livewire:show-offers type="traditional" :listing="$listing->id" :countries="$countries" :wire:key="traditional"/>
        </div>

        <div x-show="open == 'auction'">
            <livewire:show-offers type="auction" :listing="$listing->id" :countries="$countries" :wire:key="auction"/>
        </div>
    </div>
</x-backend.layout>
