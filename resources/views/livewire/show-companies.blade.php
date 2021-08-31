<div>
    <header class="flex justify-between items-center mb-5">
        <div>
            <h1 class="text-3xl font-bold">Companies</h1>
        </div>
        <div>
            <x-button-href href="{{ route('bk-company-create') }}">Create Company</x-button-href>
        </div>
    </header>

    <hr />

    <div x-data="{filters: false}">
        <div class="flex justify-between items-center">
            <div class="w-full md:w-4/5">
                <x-input type="text" wire:model.debounce.1000ms="filters.name" placeholder="Search company Term..."></x-input>
            </div>
            <div class="mt-2 w-full md:w-auto">
                <x-button-div-sec-chevron click="filters = ! filters" chevron="filters">Add Filters</x-button-div-sec-chevron>
            </div>
        </div>
        <div x-show.transition="filters" x-cloak>
            <x-backend.filters title="Companies filters">
                <x-slot name="content">
                    <div>
                        <x-label>Select Type...</x-label>
                        <x-select wire:model="filters.type">
                            <option value="">Select a Type...</option>
                            @foreach ( App\Models\Company::TYPES as $key => $type )
                                <option value="{{ $key }}">{{ $type }}</option>
                            @endforeach
                        </x-select>
                    </div>
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
                        <x-label>City</x-label>
                        <div class="flex space-x-4">
                            <x-input type="text" wire:model.debounce.1000ms="filters.city" placeholder="City..."></x-input>
                        </div>
                    </div>
                    <div>
                        <x-label>Address</x-label>
                        <div class="flex space-x-4">
                            <x-input type="text" wire:model.debounce.1000ms="filters.address" placeholder="Address..."></x-input>
                        </div>
                    </div>
                    <div>
                        <x-label>Zip Code</x-label>
                        <div class="flex space-x-4">
                            <x-input type="text" wire:model.debounce.1000ms="filters.zip" placeholder="Zip Code..."></x-input>
                        </div>
                    </div>
                    <div>
                        <x-label>Select Status...</x-label>
                        <x-select wire:model="filters.active">
                            <option value="">Select Status...</option>
                            <option value="1">Active</option>
                            <option value="0">Not Active</option>
                        </x-select>
                    </div>
                    <div>
                        <x-label>Order By...</x-label>
                        <x-select wire:model="orderBy">
                            <option value="name">Name</option>
                            <option value="type">Type</option>
                            <option value="created_at">Created At</option>
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

    <!-- companies Table -->
    <x-backend.dynamic-table :headers="['name','type','external_link','Address / Zip','City / State / Country','active', 'Created/Updated', 'Edit']">
        @foreach($companies as $i => $company)
        <tr class="text-sm hover:bg-blue-200">

            <td class="px-2 py-2 overflow-hidden">
                <x-backend.avatar-name :path="$company->logo" :name="$company->name" />
            </td>

            <td class="px-2 py-2 whitespace-nowrap">
                {{ \App\Models\Company::TYPES[$company->type] }}
            </td>

            <td class="px-2 py-2 whitespace-nowrap">
                <a class="text-blue-500 hover:text-blue-600" href="{{ $company->external_link }}">{{ $company->external_link }}</a>
            </td>

            <td class="px-2 py-2 whitespace-nowrap">
                {{ $company->address }}<br>
                {{ $company->zip }}
            </td>

            <td class="px-2 py-2 whitespace-nowrap">
                {{ $company->city }}<br>
                {{ $company->state->name }}<br>
                {{ $company->country->name }}
            </td>

            <td class="px-2 py-2 whitespace-nowrap ">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $company->active == 1 ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }}">{{ $company->active == 1 ? 'Active' : 'Not Active' }}</span>
            </td>

            <td class="px-2 py-2 whitespace-nowrap">
                {{ $company->created_at }}<br>
                {{ $company->updated_at }}
            </td>

            <td class="px-2 py-2 whitespace-nowrap text-right text-sm font-medium">
                <a href="company/{{ $company->id }}/edit" class="text-realty hover:text-realty-dark"><i class="fas fa-edit"></i></a>
            </td>
        </tr>
        @endforeach
    </x-backend.dynamic-table>

    <div class="flex flex-col justify-center pt-4">
        {!! $companies->links() !!}
    </div>
</div>
