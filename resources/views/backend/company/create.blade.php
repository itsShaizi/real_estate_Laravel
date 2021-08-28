<x-backend.layout>
    <div>
        <x-form action="{{ route('bk-company-store') }}">

            <header class="flex justify-between mb-5">
                <div>
                    <h1 class="text-3xl font-bold">Create Company</h1>
                </div>
                <div>
                    <x-button>Save Company</x-button>
                </div>
            </header>

            <x-backend.section title="General Info">
                <div class="grid grid-cols-1 md:grid-cols-3">
                    <div class="flex justify-center items-baseline">
                        <div class="p-2 space-x-5 flex items-center">
                            <x-label>Logo</x-label>
                            <x-filepond
                                class="w-40"
                                name="logo"
                                avatar-style
                                uploadUrl="{{ url('api/temp-logo-uploader') }}"
                                file-size-validation="2MB"
                                file-type-validation="image/*"
                                correct-image-orientation
                                crop-aspect-ratio="1:1"
                            />
                        </div>
                    </div>
                    <div class="md:col-start-2 md:col-span-2">
                        <div class="grid grid-cols-2"  x-data="Filters()" x-init="setStates()">

                            <div class="p-2">
                                <x-label>Name *</x-label>
                                <x-input type="text" name="name" value="{{ old('name', $company->name) }}" required />
                                <x-input-error for="name" />
                            </div>

                            <div class="p-2">
                                <x-label>Type *</x-label>
                                <x-select name="type" required>
                                    <option value="">Select Type</option>
                                    @foreach($types as $key => $type)
                                    <option
                                        value="{{ $key }}"
                                        @if (old('type', $company->type ?? '') == $key)
                                            selected
                                        @endif
                                    >
                                        {{ $type }}</option>
                                    @endforeach
                                </x-select>
                                <x-input-error for="type" />
                            </div>

                            <div class="p-2">
                                <x-label>External Link</x-label>
                                <x-input type="url" name="external_link" placeholder="https://example.com" value="{{ old('external_link', $company->external_link) }}" />
                                <x-input-error for="external_link" />
                            </div>

                            <div class="p-2">
                                <x-label>Address *</x-label>
                                <x-input type="text" name="address" value="{{ old('address', $company->address) }}" required />
                                <x-input-error for="address" />
                            </div>

                            <div class="p-2">
                                <x-label>Country *</x-label>
                                <x-select name="country_id" @change="country_id = $event.target.value; setStates();" id="country_id" required>
                                    <option value="">Select a Country...</option>
                                    @foreach($countries as $country)
                                        <option
                                            value="{{ $country->id }}"
                                            @if (
                                                old('country_id', $company->country_id ?? '') == $country->id ||
                                                empty(old('country_id', $company->country_id ?? '')) && $country->id == '233'
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

                            <div class="p-2">
                                <x-label>City *</x-label>
                                <x-input name="city" value="{{ old('city', $company->city ?? '') }}" required/>
                                <x-input-error for="city" />
                            </div>

                            <div class="p-2">
                                <x-label>Zip *</x-label>
                                <x-input type="text" name="zip" value="{{ old('zip', $company->zip) }}" required />
                                <x-input-error for="zip" />
                            </div>

                            <div class="p-2">
                                <x-label>License</x-label>
                                <x-input type="text" name="license" value="{{ old('license', $company->license) }}" />
                                <x-input-error for="license" />
                            </div>

                            {{-- The active field can be set to false when editing. --}}

                        </div>
                    </div>
                </div>
            </x-backend.section>

        </x-form>
    </div>

</x-backend.layout>

<script>
    function Filters() {
        return {
            country_id: "{{ old('country_id', $company->country_id ?? 233) }}",
            states: [],
            setStates() { //USA
                fetch('/api/states/' + this.country_id)
                .then(res => res.json())
                .then(data => {
                    this.states = data;
                });
            },
            state_id: "{{ old('state_id', $company->state_id ?? '') }}",
        }
    }
</script>
