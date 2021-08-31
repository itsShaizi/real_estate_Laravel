<div>
    <header class="flex justify-between mb-5 items-center">
        <div>
            <h1 class="text-3xl font-bold">Listings</h1>
        </div>
        <div>
            <x-button-href href="/agent-room/listing/create">Create Listing</x-button-href>
        </div>
    </header>

    <hr />

    <div x-data="{filters: false}">
        <div class="flex justify-between items-center">
            <div class="w-full md:w-4/5">
                <x-input type="text" wire:model.debounce.1000ms="filters.s_query" placeholder="Search Listing Term..."></x-input>
            </div>
            <div class="mt-2 w-full md:w-auto">
                <x-button-div-sec-chevron click="filters = ! filters" chevron="filters">Add Filters</x-button-div-sec-chevron>
            </div>
        </div>
        <div x-show="filters" x-cloak>
            <x-backend.filters title="Listing filters">
                <x-slot name="content">
                    <div>
                        <x-label>Select Country...</x-label>
                        <x-select wire:model="filters.country_id">
                            <option value="">Select a Country...</option>
                            @foreach ( $countries as $country )
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div>
                        <x-label>Select State...</x-label>
                        <x-select wire:model="filters.state_id">
                            <option value="">Select a State...</option>
                            @if(!is_null($states))
                            @foreach ( $states as $state )
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                            @endif
                        </x-select>
                    </div>
                    <div>
                        <x-label>Zip Code</x-label>
                        <div class="flex space-x-4">
                            <x-input type="text" wire:model.debounce.1000ms="filters.zip" placeholder="Zip Code..."></x-input>
                        </div>
                    </div>
                    <div>
                        <x-label>Property Type</x-label>
                        <x-select wire:model="filters.property_type">
                            <option value="">Select a Property Type...</option>
                            @foreach ( __('global.listing.property_type') as $val => $name )
                                <option value="{{ $val }}" >{{ $name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div>
                        <x-label>Listing Type</x-label>
                        <x-select wire:model="filters.listing_type">
                            <option value="">Select a Listing Type...</option>
                            @foreach ( __('global.listing.listing_type') as $val => $name )
                                <option value="{{ $val }}">{{ $name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div>
                        <!-- Select Multiple -->
                        <x-label>Select Status...</x-label>
                        <x-select wire:model="filters.status">
                            <option value="">Select a Status...</option>
                            @foreach ( __('global.listing.status') as $val => $name )
                                <option value="{{ $val }}" {{ old('status') == $val ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div>
                        <x-label>List Price</x-label>
                        <div class="flex space-x-4">
                            <x-input wire:model.debounce.1000ms="filters.min_price" placeholder="Min Price" />
                            <x-input wire:model.debounce.1000ms="filters.max_price" placeholder="Max Price" />
                        </div>
                    </div>
                </x-slot>
            </x-backend.filters>
        </div>
    </div>

    <!-- Listings Table -->
    <x-backend.table>
        @foreach($listings as $i => $listing)
            <x-backend.table-tr class="{{ $i % 2 ?: 'bg-blue-50' }}" :listing="$listing" :images="$listing->images">
            </x-backend.table-tr>
        @endforeach
    </x-backend.table>

    <div class="flex flex-col justify-center mt-4">
        {!! $listings->links() !!}
    </div>
</div>
