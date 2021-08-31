<x-backend.layout>
    <header class="flex justify-between mb-5 items-center">
        <div>
            <h1 class="text-3xl font-bold">Offers</h1>
        </div>
    </header>

    <hr />

    <div x-data="{ open: 'traditional' }">

        <div>
            <x-btn-modal type="button" @click="open = 'traditional'" x-bind:class="{'bg-blue-200': open == 'traditional'}">Traditional Offers</x-btn-modal>
            <x-btn-modal type="button" @click="open = 'auction'" x-bind:class="{'bg-blue-200': open == 'auction'}">Auction Bids</x-btn-modal>
        </div>

        <div x-show="open == 'traditional'">
            <livewire:show-offers type="traditional" :countries="$countries" :wire:key="traditional"/>
        </div>

        <div x-show="open == 'auction'">
            <livewire:show-offers type="auction" :countries="$countries" :wire:key="auction"/>
        </div>
    </div>
</x-backend.layout>
