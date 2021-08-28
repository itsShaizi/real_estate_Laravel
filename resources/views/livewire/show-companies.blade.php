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
        <div class="flex justify-between">
            <div class="w-full md:w-4/5">
                <x-input type="text" wire:model.debounce.1000ms="search" placeholder="Search company Term..."></x-input>
            </div>
            <div class="mt-2 w-full md:w-auto">
                <x-button-div-sec-chevron click="filters = ! filters" chevron="filters">Add Filters</x-button-div-sec-chevron>
            </div>
        </div>
        <div x-show.transition="filters" x-cloak>
            <!-- Filter companies -->
            {{-- <x-backend.search-filter title='Filter companies' class="text-sm" :countries="$countries"></x-backend.search-filter> --}}
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
