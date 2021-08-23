<x-backend.layout>

    <header class="flex justify-between mb-5">
        <div>
            <h1 class="text-3xl font-bold">Listings</h1>
        </div>
        <div>
            <x-button-href href="/agent-room/listing/create">Create Listing</x-button-href>
        </div>
    </header>

    <hr />

    <div x-data="{filters: false}">
        <x-form action="{{ route('bk-listing-search') }}">
            <div class="flex justify-between">
                <div class="w-full md:w-4/5">
                    <x-input type="text" name="s_query" placeholder="Search Listing Term..."></x-input>
                </div>
                <div class="mt-2 w-full md:w-auto">
                    <x-button><span class="fa fa-search"></span></x-button>
                </div>
                <div class="mt-2 w-full md:w-auto">
                    <x-button-div-sec-chevron click="filters = ! filters" chevron="filters">Add Filters</x-button-div-sec-chevron>
                </div>
            </div>
            <div x-show.transition="filters" x-cloak>
                <!-- Filter Listings -->
                <x-backend.search-filter title='Filter Listings' class="text-sm" :countries="$countries"></x-backend.search-filter>
            </div>
        </x-form>
    </div>

    <!-- Listings Table -->
    <x-backend.table>
        @foreach($listings as $i => $listing)
            <x-backend.table-tr class="{{ $i % 2 ?: 'bg-blue-50' }}" :listing="$listing" :images="$listing->images">
            </x-backend.table-tr>
        @endforeach
    </x-backend.table>

    <div class="flex flex-col justify-center">
        {!! $listings->links() !!}
    </div>

</x-backend.layout>
