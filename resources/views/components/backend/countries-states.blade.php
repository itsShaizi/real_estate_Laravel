@props([
    'oldOrCountryId' => null,
    'oldOrStateId' => '',
    'countries' => null,
])

<div {{ $attributes }} x-data="Filters()" x-init="setStates()">
    <div class="p-2">
        <x-label>Country *</x-label>
        <x-select name="country_id" @change="country_id = $event.target.value; setStates();" id="country_id" required>
            <option value="">Select a Country...</option>
            @foreach($countries as $country)
                <option
                    value="{{ $country->id }}"
                    @if (
                        $oldOrCountryId == $country->id ||
                        empty($oldOrCountryId) && $country->id == '233'
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

    <div class="p-2">
        <x-label>State *</x-label>
        <x-select name="state_id" id="state_id" required>
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
</div>

<script>
    function Filters() {
        return {
            country_id: "{{ $oldOrCountryId ?? 233 }}",
            states: [],
            setStates() { //USA
                fetch('/api/states/' + this.country_id)
                .then(res => res.json())
                .then(data => {
                    this.states = data;
                });
            },
            state_id: "{{ $oldOrStateId }}",
        }
    }
</script>
