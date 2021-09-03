<div x-data="{filters: false, hasListing: '{{ $listing ?? false }}', updateOffer: false}">
    <div>
        <div x-show="!hasListing" class="flex justify-between items-center">
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
                        <x-label>Zip Code...</x-label>
                        <div class="flex space-x-4">
                            <x-input type="text" wire:model.debounce.1000ms="filters.zip" placeholder="Zip Code..."></x-input>
                        </div>
                    </div>
                    <div>
                        <x-label>Property Type...</x-label>
                        <x-select wire:model="filters.property_type">
                            <option value="">Select a Property Type...</option>
                            @foreach ( __('global.listing.property_type') as $val => $name )
                                <option value="{{ $val }}" >{{ $name }}</option>
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
                        <x-label>List Price...</x-label>
                        <div class="flex space-x-4">
                            <x-input wire:model.debounce.1000ms="filters.min_price" placeholder="Min Price" />
                            <x-input wire:model.debounce.1000ms="filters.max_price" placeholder="Max Price" />
                        </div>
                    </div>
                    <div>
                        <x-label>Offer Amount...</x-label>
                        <div class="flex space-x-4">
                            <x-input wire:model.debounce.1000ms="filters.min_amount" placeholder="Min Offer" />
                            <x-input wire:model.debounce.1000ms="filters.max_amount" placeholder="Max Price" />
                        </div>
                    </div>
                    <div>
                        <x-label>User...</x-label>
                        <div class="flex space-x-4">
                            <x-input type="text" wire:model.debounce.1000ms="filters.user" placeholder="User Term..."></x-input>
                        </div>
                    </div>
                    <div>
                        <x-label>Order By...</x-label>
                        <x-select wire:model="orderBy">
                            <option value="created_at">Date & Time</option>
                            <option value="offer_amount">Offer Amount</option>
                        </x-select>
                    </div>
                    <div>
                        <x-label>Order By Direction...</x-label>
                        <x-select wire:model="orderByDirection">
                            <option value="asc">Ascendant</option>
                            <option value="desc">Descendant</option>
                        </x-select>
                    </div>
                </x-slot>
            </x-backend.filters>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <x-message :message="$message"/>
    @endif

    <div x-show="!hasListing">
        <x-backend.dynamic-table :headers="['Title / Address', 'Slug', 'User Name & E-mail', 'Listing Price', 'Offer Amount', 'Date & Time']">
            @foreach($offers as $i => $offer)
            <tr class="text-sm hover:bg-blue-200">
                <td class="text-base px-2 py-2 hover:text-blue-800">
                    <a href="{{ route('bk-listing-edit', $offer->listing) }}" target="_blank">
                        <div class="flex items-center">
                            <div class="w-20 h-20 bg-cover bg-center"
                                style="background-image: url({{  !empty($offer->listing->images->first()) ? '/storage/listings/images/' . $offer->listing->id . '/thumb/' .$offer->listing->images->first()->title : '/images/resources/no-image-yellow.jpg' }})">
                            </div>
                            <div class="flex flex-col">
                                <div class="pl-2 w-50 break-words">{{ $offer->listing->address }}</div>
                                <div class="pl-2 w-50 break-words">{{ $offer->listing->listing_title }}</div>
                                <div class="pl-2">{{ $offer->listing->country->iso2 }} {{ $offer->listing->state->iso2 ?? '' }} {{ $offer->listing->zip }}</div>
                                <div class="pl-2">{{ ucfirst($offer->listing->property_type) }}</div>
                            </div>
                        </div>
                    </a>
                </td>
                <td class="text-base px-2 py-2 hover:text-blue-800">
                    <a href="{{ route('listing', $offer->listing) }}" target="_blank">
                        <div class="w-40">{{ $offer->listing->slug }}</div>
                    </a>
                </td>
                <td class="text-base px-2 py-2 hover:text-blue-800">
                    <a href="{{ route('bk-user-edit', $offer->user) }}" target="_blank">
                        <x-backend.avatar-name :path="$offer->user->avatar" :name="$offer->user->first_name . ' ' . $offer->user->last_name">
                            <x-slot name="altName">
                                {{ $offer->user->first_name .' '. $offer->user->last_name }}<br>
                                {{ $offer->user->email }}
                            </x-slot>
                        </x-backend.avatar-name>
                    </a>
                </td>
                <td class="text-base px-2 py-2">
                    <div class="w-28">{{ number_format($offer->listing->list_price) }} {{ $offer->listing->list_price_unit }}</div>
                </td>
                <td class="text-base px-2 py-2">
                    <div class="w-28">{{ number_format($offer->offer_amount) }} {{ $offer->listing->list_price_unit }}</div>
                </td>
                <td class="text-base px-2 py-2">
                    <div class="w-36">
                        {{ $offer->created_at->format('M, d Y H:i') }}
                    </div>
                </td>
            </tr>
            @endforeach
        </x-backend.dynamic-table>
    </div>

    <div x-show="hasListing">
        <x-backend.dynamic-table :headers="['User Name & E-mail', 'Listing Price', 'Offer Amount', 'Outcome', 'Date & Time', '']">
            @foreach($offers as $i => $offer)
            <tr class="text-sm hover:bg-blue-200" x-bind:class="{'bg-blue-200': updateOffer == '{{ $offer->id }}'}">
                <td class="text-base px-2 py-2 hover:text-blue-800">
                    <a href="{{ route('bk-user-edit', $offer->user) }}" target="_blank">
                        <x-backend.avatar-name :path="$offer->user->avatar" :name="$offer->user->first_name . ' ' . $offer->user->last_name">
                            <x-slot name="altName">
                                {{ $offer->user->first_name .' '. $offer->user->last_name }}<br>
                                {{ $offer->user->email }}
                            </x-slot>
                        </x-backend.avatar-name>
                    </a>
                </td>
                <td class="text-base px-2 py-2">
                    <div class="w-28">{{ number_format($offer->listing->list_price) }} {{ $offer->listing->list_price_unit }}</div>
                </td>
                <td class="text-base px-2 py-2">
                    <div class="w-28">{{ number_format($offer->offer_amount) }} {{ $offer->listing->list_price_unit }}</div>
                </td>
                <td class="text-base px-2 py-2">
                    <div class="w-36">
                        {{ __('global.listing.offer_outcome')[$offer->outcome] ?? '-' }}
                    </div>
                </td>
                <td class="text-base px-2 py-2">
                    <div class="w-36">
                        {{ $offer->created_at->format('M, d Y H:i') }}
                    </div>
                </td>
                <td class="px-2 py-2 whitespace-nowrap text-sm font-medium">
                    <button
                        type="button"
                        @click="updateOffer = {{ $offer->id }}"
                        x-show="updateOffer != {{ $offer->id }}"
                        wire:click="$emit('updateOffer', '{{ $offer->id }}')"
                        class="text-realty hover:text-realty-dark"
                    >
                        <i class="fas fa-pen"></i>
                    </button>
                    <button
                        type="button"
                        @click="updateOffer = false"
                        x-show="updateOffer == {{ $offer->id }}"
                        class="text-realty text-lg hover:text-realty-dark"
                    >
                        <i class="fas fa-times"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </x-backend.dynamic-table>
    </div>

    <div class="flex flex-col justify-center mt-4">
        {!! $offers->links() !!}
    </div>

    <livewire:listings.update-offer />
</div>
