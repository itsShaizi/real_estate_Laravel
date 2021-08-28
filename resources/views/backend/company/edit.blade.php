<x-backend.layout>
    <div>
        <x-form action="{{ route('bk-company-update', $company) }}" method="PUT">

            <header class="flex justify-between mb-5">
                <div>
                    <h1 class="text-3xl font-bold">Edit Company</h1>
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
                            <x-filepond-image-edit :image="$company->logo" name="logo" temporaryPath="api/temp-logo-uploader"/>
                        </div>
                    </div>
                    <div class="md:col-start-2 md:col-span-2">
                        <div class="grid grid-cols-2">

                            <div class="p-2 col-span-2 md:col-span-1">
                                <x-label>Name *</x-label>
                                <x-input type="text" name="name" value="{{ old('name', $company->name) }}" required />
                                <x-input-error for="name" />
                            </div>

                            <div class="p-2 col-span-2 md:col-span-1">
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

                            <div class="p-2 col-span-2 md:col-span-1">
                                <x-label>External Link</x-label>
                                <x-input type="url" name="external_link" placeholder="https://example.com" value="{{ old('external_link', $company->external_link) }}" />
                                <x-input-error for="external_link" />
                            </div>

                            <div class="p-2 col-span-2 md:col-span-1">
                                <x-label>Address *</x-label>
                                <x-input type="text" name="address" value="{{ old('address', $company->address) }}" required />
                                <x-input-error for="address" />
                            </div>

                            <x-backend.countries-states class="col-span-2 md:grid md:grid-cols-2" :countries="$countries" :oldOrCountryId="old('country_id', $company->country_id ?? '')" :oldOrStateId="old('state_id', $company->state_id ?? '')" />

                            <div class="p-2 col-span-2 md:col-span-1">
                                <x-label>City *</x-label>
                                <x-input name="city" value="{{ old('city', $company->city ?? '') }}" required/>
                                <x-input-error for="city" />
                            </div>

                            <div class="p-2 col-span-2 md:col-span-1">
                                <x-label>Zip *</x-label>
                                <x-input type="text" name="zip" value="{{ old('zip', $company->zip) }}" required />
                                <x-input-error for="zip" />
                            </div>

                            <div class="p-2 col-span-2 md:col-span-1">
                                <x-label>License</x-label>
                                <x-input type="text" name="license" value="{{ old('license', $company->license) }}" />
                                <x-input-error for="license" />
                            </div>

                            <div class="p-2 md:col-span-2">
                                <x-label>
                                    <x-input-checkbox name="active" value="{{ $company->active ?? old('active') }}"
                                        label="Is Active?" />
                                </x-label>
                            </div>

                        </div>
                    </div>
                </div>
            </x-backend.section>
        </x-form>

        <x-backend.section title="Danger Zone">

            <x-backend.delete-model
                label="Delete Company"
                route="{{ route('bk-company-delete', $company) }}"
                submitLabel="Delete Company"
                triggerButton="Delete Company"
                modalTitle="Delete Company"
                formId="{{ 'delete-company-'.$company->id }}"
            >
                <x-slot name="description">Once you delete this company, there is no going back. Please be certain.</x-slot>
                <x-slot name="modalDescription">This action cannot be undone. This will permanently delete the company.</x-slot>
            </x-backend.delete-model>

        </x-backend.section>

    </div>

</x-backend.layout>
