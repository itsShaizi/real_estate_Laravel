<div>
    <header class="flex justify-between mb-5">
        <div>
            <h1 class="text-3xl font-bold">Feeds</h1>
        </div>
    </header>

    <hr />

    <!-- Feeds Table -->
    <x-backend.dynamic-table :headers="['','Feed Name', 'Type', 'Status', 'Parser Class', 'Created', 'Edit']">
        @foreach($feeds as $i => $feed)
        <tr class="text-sm hover:bg-blue-100">
            <td class="text-base px-2 py-2">
                <input type="checkbox" class="h-5 w-5 text-gray-600" wire:model="selectedFeeds" value="{{ $feed->name }}">
            </td>
            <td class="text-base px-2 py-2">
                {{ $feed->name }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap">
                <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">{{ $feed->type }}</span>
            </td>
            <td class="auction-2 py-2 whitespace-nowrap">
                <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $feed->status }}</span>
            </td>
            <td class="px-2 py-2 whitespace-nowrap">
                {{ $feed->feed_class }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap">
                {{ $feed->created_at }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap text-right text-sm font-medium">
                <a href="user/{{ $feed->id }}/edit" class="text-realty hover:text-realty-dark"><i
                        class="fas fa-edit"></i></a>
            </td>
        </tr>
        @endforeach
    </x-backend.dynamic-table>


    <!-- Stats -->
    <div id="wrapper" class="w-full px-4 py-4 mx-auto">
        <div class="sm:grid sm:grid-flow-row sm:gap-4 sm:grid-cols-4">
            <div id="total_listings"
                class="sm:col-start-2 flex flex-col justify-center px-4 py-4 bg-white border border-gray-300 rounded">
                <div>
                    <p class="text-3xl font-semibold text-center text-gray-800">{{ number_format($listings->count()) }}
                    </p>
                    <p class="text-lg text-center text-gray-500">Total Listings</p>
                </div>
            </div>

            <div id="total_volume"
                class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 rounded sm:mt-0">
                <div>
                    <p class="text-3xl font-semibold text-center text-gray-800">
                        @if($listings->sum('list_price') >= 1000000 && $listings->sum('list_price') < 1000000000)
                        {{ number_format($listings->sum('list_price') / 1000000). ' mill ' }}
                        @elseif($listings->sum('list_price') >= 1000000000 && $listings->sum('list_price') < 1000000000000)
                        {{ number_format($listings->sum('list_price') / 1000000). ' bill ' }}
                        @elseif($listings->sum('list_price') >= 1000000000000 && $listings->sum('list_price') < 1000000000000000)
                        {{ number_format($listings->sum('list_price') / 1000000). ' trill ' }}
                        @elseif($listings->sum('list_price') >= 1000000000000000 && $listings->sum('list_price') < 1000000000000000000)
                        {{ number_format($listings->sum('list_price') / 1000000). ' quad ' }}
                        @elseif ($listings->sum('list_price') < 1000000000000000)
                        {{ number_format($listings->sum('list_price')) }}
                        @endif
                         USD</p>
                    <p class="text-lg text-center text-gray-500">Total Volume</p>
                </div>
            </div>

            <div id="min_list_price" class="sm:col-start-1 flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 rounded sm:mt-0">
                <div>
                    <p class="text-3xl font-semibold text-center text-gray-800">
                        {{ number_format($listings->min('list_price')) }} USD</p>
                    <p class="text-lg text-center text-gray-500">Min List Price</p>
                </div>
            </div>

            <div id="max_list_price" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 rounded sm:mt-0">
                <div>
                    <p class="text-3xl font-semibold text-center text-gray-800">
                        {{ number_format($listings->max('list_price')) }} USD</p>
                    <p class="text-lg text-center text-gray-500">Max List Price</p>
                </div>
            </div>

            <div id="median_list_price" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 rounded sm:mt-0">
                <div>
                    <p class="text-3xl font-semibold text-center text-gray-800">
                        {{ number_format($listings->median('list_price') ) }} USD
                    </p>
                    <p class="text-lg text-center text-gray-500">Median List Price</p>
                </div>
            </div>

            <div id="average_list_price" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 rounded sm:mt-0">
                <div>
                    <p class="text-3xl font-semibold text-center text-gray-800">
                        {{ number_format($listings->avg('list_price')) }} USD</p>
                    <p class="text-lg text-center text-gray-500">Average List Price</p>
                </div>
            </div>

            <div id="min_dom" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 rounded sm:mt-0">
                <div>
                    <p class="text-3xl font-semibold text-center text-gray-800">
                        {{ number_format($listings->min('dom'))}}
                    </p>
                    <p class="text-lg text-center text-gray-500">Min DOM</p>
                </div>
            </div>

            <div id="max_dom" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 rounded sm:mt-0">
                <div>
                    <p class="text-3xl font-semibold text-center text-gray-800">
                        {{ number_format($listings->max('dom')) }}
                    </p>
                    <p class="text-lg text-center text-gray-500">Max DOM</p>
                </div>
            </div>

            <div id="median_dom" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 rounded sm:mt-0">
                <div>
                    <p class="text-3xl font-semibold text-center text-gray-800">
                        {{ number_format($listings->median('dom')) }}
                    </p>
                    <p class="text-lg text-center text-gray-500">Median DOM</p>
                </div>
            </div>

            <div id="average_dom" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 rounded sm:mt-0">
                <div>
                    <p class="text-3xl font-semibold text-center text-gray-800">
                        {{ number_format($listings->avg('dom') ) }}
                    </p>
                    <p class="text-lg text-center text-gray-500">Average DOM</p>
                </div>
            </div>

        </div>
    </div>

    {{-- Filters --}}
    <div x-data="{filters: @entangle('showFilters')}">
        <div class="flex justify-end items-center mt-2 space-x-2">
            <div wire:loading.delay wire:target="export">
                Generating File...
            </div>
            <div>
                <x-button-div-sec click="$wire.export()"><div class="flex items-center space-x-2"><i class="fas fa-download" aria-hidden="true"></i><span>Export</span></div></x-button-div-sec>
            </div>
            <div class="w-full md:w-auto">
                <x-button-div-sec-chevron click="filters = ! filters" chevron="filters"><span x-show="!filters">Show</span><span x-show="filters">Hide</span> Filters
                </x-button-div-sec-chevron>
            </div>
        </div>
        <div x-show.transition="filters" x-cloak>

            <div class="border flex flex-col rounded mt-4 text-sm">
                <header class="bg-gray-100 font-bold px-3 py-2 md:px-5 md:py-3">Filter Feeds</header>
                <div class="px-2 md:py-4 md:px-5">
                    @foreach($filters as $key => $filter)
                    <div wire:key="{{ $loop->index }}">

                        <div class="flex justify-end items-center space-x-2 mb-2">
                            <span class="text-gray-700 hover:text-gray-800 cursor-pointer" wire:click="clearFilter({{ $key }})">Clear</span>
                        </div>
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3 md:grid-cols-4">
                            <div>
                                <x-label>Select Country</x-label>
                                <x-select wire:model="filters.{{ $key }}.country_id">
                                    <option value="">Select a Country...</option>
                                    @foreach ( $countries as $country )
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div>
                                <x-label>City</x-label>
                                <x-input type="text" wire:model.debounce.1000ms="filters.{{ $key }}.city"
                                    placeholder="City..."></x-input>
                            </div>
                            <div>
                                <x-label>Zip Code</x-label>
                                <x-input type="text" wire:model.debounce.1000ms="filters.{{ $key }}.zip"
                                    placeholder="Zip Code..."></x-input>
                                <span class="text-gray-600 text-sm ml-2">Separate by ","</span>
                            </div>
                            <div>
                                <x-label>Property Type</x-label>
                                <x-select wire:model="filters.{{ $key }}.property_type">
                                    <option value="">Select a Property Type...</option>
                                    @foreach ( __('global.listing.property_type') as $val => $name )
                                        <option value="{{ $val }}">{{ $name }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div>
                                <x-label>Listing Type</x-label>
                                <x-select wire:model="filters.{{ $key }}.listing_type">
                                    <option value="">Select a Listing Type...</option>
                                    @foreach ( __('global.listing.listing_type') as $val => $name )
                                        <option value="{{ $val }}">{{ $name }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div>
                                <x-label>Price Range</x-label>
                                <div class="space-y-2">
                                    <div class="flex items-center space-x-2" >
                                        <x-input name="min_price" placeholder="Min Price" id="min_price" wire:model.debounce.500ms="filters.{{ $key }}.min_price" wire:key="min_price-{{ $loop->index }}"/>
                                        <x-input name="max_price" placeholder="Max Price" id="max_price" wire:model.debounce.500ms="filters.{{ $key }}.max_price" wire:key="max_price-{{ $loop->index }}"/>
                                        @if($filter['min_price'] || $filter['max_price'])
                                        <button wire:click="clearPriceRange({{ $key }})" class="mt-2 text-gray-500 hover:text-gray-700"><i class="fas fa-times" aria-hidden="true"></i></button>
                                        @endif
                                    </div>
                                    @if(!($filter['min_price'] >= '150000' || ($filter['min_price'] == '0' && $filter['max_price'] == '150000')))
                                    <div class="flex">
                                        <button wire:click="setUpTo150k({{ $key }})" class="ml-2 text-gray-500 hover:text-gray-700"><span>Up to 150,000 USD</span></button>
                                    </div>
                                    @endif
                                    @if(!(($filter['min_price'] >= '500000') || ($filter['max_price'] != '' && $filter['max_price'] <= '150000') || ($filter['min_price'] == '150000' && $filter['max_price'] == '500000') ))
                                    <div class="flex">
                                        <button wire:click="setFrom150kTo500k({{ $key }})" class="ml-2 text-gray-500 hover:text-gray-700"><span>150,000 USD - 500,000 USD</span></button>
                                    </div>
                                    @endif
                                    @if(!(($filter['min_price'] >= '1000000') || ($filter['max_price'] != '' && $filter['max_price'] <= '500000') || ($filter['min_price'] == '500000' && $filter['max_price'] == '1000000')))
                                    <div class="flex">
                                        <button wire:click="setFrom500kTo1m({{ $key }})" class="ml-2 text-gray-500 hover:text-gray-700"><span>500,000 USD - 1,000,000 USD</span></button>
                                    </div>
                                    @endif
                                    @if(!(($filter['min_price'] >= '1000000') || ($filter['max_price'] != '' && $filter['max_price'] <= '1000000')))
                                    <div class="flex">
                                        <button wire:click="setMoreThan1m({{ $key }})" class="ml-2 text-gray-500 hover:text-gray-700"><span>More than 1,000,000 USD</span></button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <x-label>Days on the Market</x-label>
                                <div class="space-y-2">
                                    <div class="flex space-x-4" wire:key="dom-{{ $loop->index }}">
                                        <x-input name="min_dom" placeholder="Min dom" id="min_dom" wire:model.debounce.500ms="filters.{{ $key }}.min_dom"  wire:key="min_dom-{{ $loop->index }}"/>
                                        <x-input name="max_dom" placeholder="Max dom" id="max_dom" wire:model.debounce.500ms="filters.{{ $key }}.max_dom"  wire:key="max_dom-{{ $loop->index }}"/>
                                        @if($filter['min_dom'] || $filter['max_dom'])
                                        <button wire:click="clearDomRange({{ $key }})" class="mt-2 text-gray-500 hover:text-gray-700"><i class="fas fa-times" aria-hidden="true"></i></button>
                                        @endif
                                    </div>
                                    @if(!($filter['min_dom'] >= '90' || ($filter['min_dom'] == '0' && $filter['max_dom'] == '90')))
                                    <div class="flex">
                                        <button wire:click="setUpTo90d({{ $key }})" class="ml-2 text-gray-500 hover:text-gray-700"><span>Up to 90 days</span></button>
                                    </div>
                                    @endif
                                    @if(!(($filter['min_dom'] >= '180') || ($filter['max_dom'] != '' && $filter['max_dom'] <= '90') || ($filter['min_dom'] == '90' && $filter['max_dom'] == '180') ))
                                    <div class="flex">
                                        <button wire:click="setFrom90dTo180d({{ $key }})" class="ml-2 text-gray-500 hover:text-gray-700"><span>90 days - 180 day</span></button>
                                    </div>
                                    @endif
                                    @if(!(($filter['min_dom'] >= '365') || ($filter['max_dom'] != '' && $filter['max_dom'] <= '180') || ($filter['min_dom'] == '180' && $filter['max_dom'] == '365')))
                                    <div class="flex">
                                        <button wire:click="setFrom180dTo1Y({{ $key }})" class="ml-2 text-gray-500 hover:text-gray-700"><span>180 days - 1 year</span></button>
                                    </div>
                                    @endif
                                    @if(!(($filter['min_dom'] >= '365') || ($filter['max_dom'] != '' && $filter['max_dom'] <= '365')))
                                    <div class="flex">
                                        <button wire:click="setMoreThan1Y({{ $key }})" class="ml-2 text-gray-500 hover:text-gray-700"><span>More than 1 year</span></button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    @unless ($loop->last)
                    <div class="flex justify-center">
                        <span>OR</span>
                    </div>
                    @endunless
                    @endforeach


                    <div class="flex mt-2">
                        <x-button-div-sec click="$wire.addFitler()">Add Filter</x-button-div-sec>
                        <x-button-div-sec click="$wire.removeFilters()">Remove Filters</x-button-div-sec>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Listings Table -->
    <div>
        @if($listings->count() > 0)
        <x-backend.table>
            <x-slot name="tableHeader">
                <x-backend.table-th sortable multi-column wire:click="sortBy('address')" :direction="$sorts['address'] ?? null">
                    Address/Title
                </x-backend.table-th>
                <x-backend.table-th sortable multi-column wire:click="sortBy('city')" :direction="$sorts['city'] ?? null">
                    City
                </x-backend.table-th>
                <x-backend.table-th>
                    State
                </x-backend.table-th>
                <x-backend.table-th>
                    Country
                </x-backend.table-th>
                <x-backend.table-th sortable multi-column wire:click="sortBy('status')" :direction="$sorts['status'] ?? null">
                    Status
                </x-backend.table-th>
                <x-backend.table-th sortable multi-column wire:click="sortBy('listing_type')" :direction="$sorts['listing_type'] ?? null">
                    Listing Type
                </x-backend.table-th>
                <x-backend.table-th sortable multi-column wire:click="sortBy('property_type')" :direction="$sorts['property_type'] ?? null">
                    Property Type
                </x-backend.table-th>
                <x-backend.table-th sortable multi-column wire:click="sortBy('list_price')" :direction="$sorts['list_price'] ?? null">
                    List Price
                </x-backend.table-th>
                <x-backend.table-th>
                    <span class="sr-only">Edit</span>
                </x-backend.table-th>
            </x-slot>
            @foreach($listings->slice(0, 10) as $i => $listing)
                <x-backend.table-tr class="{{ $i % 2 ?: 'bg-blue-50' }}" :listing="$listing" :images="$listing->images">
                </x-backend.table-tr>
            @endforeach
        </x-backend.table>
        @endif
    </div>
</div>
