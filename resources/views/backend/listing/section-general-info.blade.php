<x-backend.section title="General Info">
    <div>
        <div class="md:flex md:justify-between md:items-center text-sm">
            <div>
                <x-label>Seller Type</x-label>
                <x-select name="seller_type">
                    @foreach ( __('global.listing.seller_type') as $val => $name )
                        <option
                            value="{{ $val }}"
                            @if (old('seller_type', $listing->seller_type ?? '') === $val)
                                selected
                            @endif
                        >
                            {{ $name }}
                        </option>
                    @endforeach
                </x-select>
                <x-input-error for="seller_type" />
            </div>
            <div>
                <div>
                    <input type="hidden" name="cashifyd" value="0">
                    <input
                        type="checkbox"
                        class="form-checkbox rounded"
                        name="cashifyd"
                        value="1"
                        @if (old('cashifyd', $listing->cashifyd ?? '') === '1')
                            checked
                        @endif
                    >
                    <span class="ml-2">Remove Cashifyd</span>
                </div>
                <x-input-error for="cashifyd" />
            </div>
        </div>
        <hr class="my-4"/>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <x-label>
                    RealtyHive Rep <span class="fas fa-exclamation-circle"></span>
                </x-label>
                <livewire:user-search-component name="realtyhive_rep" value="{{ old('realtyhive_rep', $listing->realtyhive_rep ?? '') }}" />
                <x-input-error for="realtyhive_rep" />
            </div>
            <div>
                <x-label>
                    RealtyHive Liaison <span class="fas fa-exclamation-circle"></span>
                </x-label>
                <livewire:user-search-component name="realtyhive_liaison" value="{{ old('realtyhive_liaison', $listing->realtyhive_liaison ?? '') }}" />
                <x-input-error for="realtyhive_liaison" />
            </div>
            <div>
                <x-label>
                    Real Estate Agent <span class="fas fa-exclamation-circle"></span>
                </x-label>
                <livewire:user-search-component name="real_estate_agent" value="{{ old('real_estate_agent', $listing->real_estate_agent ?? '') }}" />
                <x-input-error for="realestate_agent" />
            </div>
            <div>
                <x-label>
                    Listing Type *
                </x-label>
                <x-select name="listing_type">
                    @foreach ( __('global.listing.listing_type') as $val => $name )
                        <option
                            value="{{ $val }}"
                            @if (old('listing_type', $listing->listing_type ?? '') === $val)
                                selected
                            @endif
                        >
                            {{ $name }}
                        </option>
                    @endforeach
                </x-select>
                <x-input-error for="listing_type" />
            </div>
            <div>
                <x-label>Property Type *</x-label>
                <x-select name="property_type">
                    @foreach ( __('global.listing.property_type') as $val => $name )
                        <option
                            value="{{ $val }}"
                            @if (old('property_type', $listing->property_type ?? '') === $val)
                                selected
                            @endif
                        >
                            {{ $name }}
                        </option>
                    @endforeach
                </x-select>
                <x-input-error for="property_type" />
            </div>
            <div>
                <!-- Multiple Select -->
                <x-label>Additional Property Types *</x-label>
                <x-multi-select 
                    placeholder="Select Additional Property Types" 
                    name="additional_property_types" 
                    :unselected="$additional_property_types" 
                    :selected="$selected_additional_property_types" 
                /> {{-- TODO: Add Handle Old Values and Required --}}
                <x-input-error for="additional_property_types" />
            </div>
        </div>
    </div>
</x-backend.section>

<x-backend.section title="Property Address" class="grid gap-4">
    <div>
        <x-label>Listing Title</x-label>
        <x-input name="listing_title" value="{{ old('listing_title', $listing->listing_title ?? '') }}" />
        <x-input-error for="listing_title" />
    </div>
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <x-label>Address</x-label>
            <x-input name="address" value="{{ old('address', $listing->address ?? '') }}" />
            <x-input-error for="address" />
        </div>
        <div>
            <x-label>Slug (Url used to access listing)</x-label>
            <x-input
                name="slug"
                value="{{ old('slug', $listing->slug ?? '') }}"
                :disabled="request()->routeIs('bk-listing-create')"
            />
            <x-input-error for="slug" />
        </div>
    </div>
    <div class="grid md:grid-cols-3 gap-4" x-data="Filters()" x-init="setStates()">
        <div>
            <x-label>Country *</x-label>
            <x-select name="country_id" @change="country_id = $event.target.value; setStates();" id="country_id">
                <option value="">Select a Country...</option>
                @foreach($countries as $country)
                    <option
                        value="{{ $country->id }}"
                        @if (
                            old('country_id', $listing->country_id ?? '') == $country->id ||
                            empty(old('country_id', $listing->country_id ?? '')) && $country->id == '233'
                        )
                            selected
                        @endif
                    >
                        {{ $country->name }}
                    </option>
                @endforeach
            </x-select>
            <x-input-error for="country_id" />
        </div>
        <div>
            <x-label>State *</x-label>
            <x-select name="state_id" id="state_id">
                <option value="">Select State...</option>
                <template x-for="state in states">
                    <option 
                        :value="state.id" 
                        :selected="state.id == state_id"
                        x-text="state.name"
                    ></option>
                </template>
            </x-select>
            <x-input-error for="state_id" />
        </div>
        <div>
            <x-label>City *</x-label>
            <x-input name="city" value="{{ old('city', $listing->city ?? '') }}" />
            <x-input-error for="city" />
        </div>
        <div>
            <x-label>Zip *</x-label>
            <x-input name="zip" value="{{ old('zip', $listing->zip ?? '') }}" />
            <x-input-error for="zip" />
        </div>
        <div>
            <x-label>County</x-label>
            <x-input name="county" value="{{ old('county', $listing->county ?? '') }}" />
            <x-input-error for="county" />
        </div>
        <div>
            <x-label>Municipality</x-label>
            <x-input name="municipality" value="{{ old('municipality', $listing->municipality ?? '') }}" />
            <x-input-error for="municipality" />
        </div>
    </div>
    <hr class="my-4"/>
    <div class="grid md:grid-cols-3 gap-4">
        <div>
            <x-label>Enter Latitude & Longitude Manually?</x-label>
            <div class="flex space-x-4">
                <div>
                    <input
                        type="radio"
                        class="form-radio"
                        name="lat_long_manual"
                        value="0"
                        @if (old('lat_long_manual', $listing->lat_long_manual ?? '') !== '1')
                            checked
                        @endif /> No
                </div>
                <div>
                    <input
                        type="radio"
                        class="form-radio"
                        name="lat_long_manual"
                        value="1"
                        @if (old('lat_long_manual', $listing->lat_long_manual ?? '') === '1')
                            checked
                        @endif /> Yes
                </div>
            </div>
            <x-input-error for="lat_long_manual" />
        </div>
        <div>
            <x-label>Latitude</x-label>
            <x-input name="latitude" value="{{ old('latitude', $listing->latitude ?? '') }}" />
            <x-input-error for="latitude" />
        </div>
        <div>
            <x-label>Longitude</x-label>
            <x-input name="longitude" value="{{ old('longitude', $listing->longitude ?? '') }}" />
            <x-input-error for="longitude" />
        </div>
    </div>
</x-backend.section>

<x-backend.section title="Property Attributes" class="grid gap-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <x-label>Parcel Number</x-label>
            <x-input name="parcel_number" value="{{ old('parcel_number', $listing->parcel_number ?? '') }}" />
            <x-input-error for="parcel_number" />
        </div>
        <div>
            <x-label>Year Built</x-label>
            <x-input name="year_built" value="{{ old('year_built', $listing->year_built ?? '') }}" />
            <x-input-error for="year_built" />
        </div>
        <div>
            <x-label>Lot Size</x-label>
            <x-input name="lot_size" value="{{ old('lot_size', $listing->lot_size ?? '') }}" />
            <x-input-error for="lot_size" />
        </div>
        <div>
            <x-label>Units</x-label>
            <x-input name="units" value="{{ old('units', $listing->units ?? '') }}" />
            <x-input-error for="units" />
        </div>
        <div>
            <x-label>Beds</x-label>
            <x-input name="beds" value="{{ old('beds', $listing->beds ?? '') }}" />
            <x-input-error for="beds" />
        </div>
        <div>
            <x-label>Half Baths</x-label>
            <x-input name="half_baths" value="{{ old('half_baths', $listing->half_baths ?? '') }}" />
            <x-input-error for="half_baths" />
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <x-label>Description *</x-label>
            <textarea id="editor1" name="description">{{ old('description', $listing->description ?? '') }}</textarea>
            <x-input-error for="description" />
        </div>
        <div>
            <x-label>Directions</x-label>
            <textarea id="editor2" name="directions">{{ old('directions', $listing->directions ?? '') }}</textarea>
            <x-input-error for="directions" />
        </div>
        <div>
            <x-label>Terms and Conditions</x-label>
            <textarea id="editor3" name="terms_and_conditions">{{ old('terms_and_conditions', $listing->terms_and_conditions ?? '') }}</textarea>
            <x-input-error for="terms_and_conditions" />
        </div>
        <div>
            <x-label>Local Economy</x-label>
            <textarea id="editor4" name="local_economy">{{ old('local_economy', $listing->local_economy ?? '') }}</textarea>
            <x-input-error for="local_economy" />
        </div>
    </div>
</x-backend.section>
<x-backend.section title="Property SEO / Advertising">
    <div>
        <x-label>Ad Description</x-label>
        <x-input name="ad_description" value="{{ old('ad_description', $listing->ad_description ?? '') }}" />
        <x-input-error for="ad_description" />
    </div>
</x-backend.section>

<script>
    function Filters() {
        return {
            country_id: "{{ old('country_id', $listing->country_id ?? 233) }}",
            states: [],
            setStates() { //USA
                fetch('/api/states/' + this.country_id)
                .then(res => res.json())
                .then(data => {
                    this.states = data;
                });
            },
            state_id: "{{ old('state_id', $listing->state_id ?? '') }}",
        }
    }
</script>
