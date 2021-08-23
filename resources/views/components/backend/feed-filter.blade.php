<div class="border flex flex-col rounded mt-4" x-data="Filters()" x-init="setStates()">
    <header class="bg-gray-100 font-bold px-3 py-2 md:px-5 md:py-3">{{ $title }}</header>
    <content class="py-5 px-2 md:py-10 md:px-5">
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3 md:grid-cols-4">
            <!-- Second Row -->
            <div>
                <x-label>Zip Code</x-label>
                <x-input name="zip" id="zip" />
            </div>
            <div>
                <x-label>Days on the Market</x-label>
                <div class="flex">
                    <x-select name="property_type" id="property_type">
                        <option value=">=">Greater or equal than:</option>
                        <option value=">">Greater than:</option>
                        <option value="<=">Less or equal than:</option>
                        <option value="<">Less than:</option>
                    </x-select>
                    <x-input name="dom" id="dom" value="{{ old('dom') }}"/>
                </div>
            </div>
            <div>
                <x-label>Price Range</x-label>
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

