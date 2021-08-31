<div class="border flex flex-col rounded mt-4">
    <header class="bg-gray-100 font-bold px-3 py-2 md:px-5 md:py-3">
        <div class="flex justify-between items-center">
            <div>{{ $title }}</div>
            <div><button class="border-2 border-gray-400 hover:border-blue-400 rounded-full p-2 px-4 cursor-pointer" wire:click="clearFilters">Clear Filters</button></div>
        </div>
    </header>
    <content class="py-5 px-2 md:py-10 md:px-5">
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3 md:grid-cols-4">

            {{ $content }}

        </div>
    </content>
</div>
