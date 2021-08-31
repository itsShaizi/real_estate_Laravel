<div class="border flex flex-col rounded mt-4" x-data="Filters()" x-init="setStates()">
    <header class="bg-gray-100 font-bold px-3 py-2 md:px-5 md:py-3">{{ $title }}</header>
    <content class="py-5 px-2 md:py-10 md:px-5">
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3 md:grid-cols-4">

            @if(isset($content))

            {{ $content }}

            @else
            <!-- First Row -->
            <div>
                <x-label>Country</x-label>
                <x-select name="country" @change="country = $event.target.value; setStates();" id="country">
                    <option value="">Select a Country...</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                    @endforeach
                </x-select>
            </div>
            <div>
                <x-label>State</x-label>
                <x-select name="state" id="state">
                    <option value="">Select State...</option>
                    <template x-for="state in states">
                        <option :value="state.id" x-text="state.name"></option>
                    </template>
                </x-select>
            </div>
            <!-- Second Row -->
            <div>
                <x-label>Zip Code</x-label>
                <x-input name="zip" id="zip" />
            </div>
            <div>
                <x-label>Property Type</x-label>
                <x-select name="property_type" id="property_type">
                    <option value="">Select a Property Type...</option>
                    @foreach ( __('global.listing.property_type') as $val => $name )
                        <option value="{{ $val }}" {{ old('property_type') == $val ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </x-select>
            </div>
            <div>
                <x-label>Listing Type</x-label>
                <x-select name="listing_type" id="listing_type">
                    <option value="">Select a Listing Type...</option>
                    @foreach ( __('global.listing.listing_type') as $val => $name )
                        <option value="{{ $val }}" {{ old('listing_type') == $val ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </x-select>
            </div>
            <div>
                <!-- Select Multiple -->
                <x-label>Select Status...</x-label>
                <x-select name="status" id="status">
                    <option value="">Select a Status...</option>
                    @foreach ( __('global.listing.status') as $val => $name )
                        <option value="{{ $val }}" {{ old('status') == $val ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </x-select>
            </div>
            <div>
                <x-label>List Price</x-label>
                <div class="flex space-x-4">
                    <x-input name="min_price" placeholder="Min Price" id="min_price" value="{{ old('min_price') }}"/>
                    <x-input name="max_price" placeholder="Max Price" id="max_price" value="{{ old('max_price') }}"/>
                </div>
            </div>
            <div class="flex justify-end space-x-4 mt-5 py-2">
                <x-button>Filter</x-button>
                <x-button-div-sec click="clearFilters()">Clear Filters</x-button-div-sec>
            </div>
        </div>

        @endif

    </content>
</div>

<script>
function Filters() {
    return {
        country: 233,
        states: [],
        setStates() { //USA
            fetch('/api/states/' + this.country)
            .then(res => res.json())
            .then(data => {
                this.states = data;
            });
        },
        clearFilters() {
            console.log('clearing filters');
            document.getElementById('country').value = '';
            document.getElementById('state').value = '';
            document.getElementById('zip').value = '';
            document.getElementById('property_type').value = '';
            document.getElementById('listing_type').value = '';
            document.getElementById('status').value = '';
            document.getElementById('min_price').value = '';
            document.getElementById('max_price').value = '';
        }
    }
}
</script>

