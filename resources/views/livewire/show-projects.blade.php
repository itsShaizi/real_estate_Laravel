<div>
    <header class="flex justify-between mb-5 items-center">
        <div>
            <h1 class="text-3xl font-bold">Projects</h1>
        </div>
        <div>
            <x-button-href href="/agent-room/project/create">Create Project</x-button-href>
        </div>
    </header>

    <hr />

    <div x-data="{filters: false}">
        <div class="flex justify-between items-center">
            <div class="w-full md:w-4/5">
                <x-input type="text" wire:model.debounce.1000ms="filters.s_query" placeholder="Search Project Term..."></x-input>
            </div>
            <div class="mt-2 w-full md:w-auto">
                <x-button-div-sec-chevron click="filters = ! filters" chevron="filters">Add Filters</x-button-div-sec-chevron>
            </div>
        </div>
        <div x-show="filters" x-cloak>
            <x-backend.filters title="Project filters">
                <x-slot name="content">
                    <div>
                        <x-label>Select Company...</x-label>
                        <x-select wire:model="filters.business_id">
                            <option value="">Select a Company...</option>
                            @foreach ( $companies as $pcompany )
                                <option value="{{ $pcompany->id }}">{{ $pcompany->name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div>
                        <x-label>Block number</x-label>
                        <div class="flex space-x-4">
                            <x-input type="text" wire:model.debounce.1000ms="filters.number_block" placeholder="Block number..."></x-input>
                        </div>
                    </div>
                    <div>
                        <x-label>Floor number</x-label>
                        <div class="flex space-x-4">
                            <x-input type="text" wire:model.debounce.1000ms="filters.number_floor" placeholder="Floor number..."></x-input>
                        </div>
                    </div>
                    <div>
                        <x-label>Flat number</x-label>
                        <div class="flex space-x-4">
                            <x-input type="text" wire:model.debounce.1000ms="filters.number_flat" placeholder="Flat number..."></x-input>
                        </div>
                    </div>

                    <div>
                        <x-label>Finish Date (From/To)</x-label>
                        <div class="flex space-x-4">
                            <x-input type="date" wire:model.debounce.1000ms="filters.date_finish_from" placeholder="From..."></x-input>
                            <x-input type="date" wire:model.debounce.1000ms="filters.date_finish_to" placeholder="To..."></x-input>
                        </div>
                    </div>

                    <div>
                        <x-label>Sell Date (From/To)</x-label>
                        <div class="flex space-x-4">
                            <x-input type="date" wire:model.debounce.1000ms="filters.date_sell_from" placeholder="From..."></x-input>
                            <x-input type="date" wire:model.debounce.1000ms="filters.date_sell_to" placeholder="To..."></x-input>
                        </div>
                    </div>

                    <div>
                        <x-label> Price </x-label>
                        <div class="flex space-x-4">
                            <x-input wire:model.debounce.1000ms="filters.price_from" placeholder="Min Price" />
                            <x-input wire:model.debounce.1000ms="filters.price_to" placeholder="Max Price" />
                        </div>
                    </div>

                    <div>
                        <x-label>Select Status...</x-label>
                        <x-select wire:model="filters.status">
                            <option value="">Select a Status...</option>
                            @foreach ( __('global.project.status') as $val => $name )
                                <option value="{{ $val }}" {{ old('status') == $val ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    
                </x-slot>
            </x-backend.filters>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <x-message :message="$message"/>
    @endif

    <!-- Projects Table -->
    <x-backend.dynamic-table :headers="['Name','Location','Listings','Company','Price From','Price To','Featured','Status','Action']">
         @foreach($projects as $i => $project)
        <tr class="text-sm hover:bg-blue-200">

            <td class="text-base px-2 py-2">
                <div class="flex items-center">
                    <div class="w-20 h-20 bg-cover bg-center" style="background-image: url({{  !empty($project->images->first()) ? '/storage/projects/images/' . $project->id . '/thumb/' .$project->images->first()->title : '/images/resources/no-image-yellow.jpg' }})"></div>
                    <div class="pl-2 w-40 break-words">{{ $project->name }}</div>
                </div>
            </td>

            <td class="px-2 py-2 whitespace-nowrap">
                {{ $project->location }}
            </td>

            <td class="px-2 py-2 whitespace-nowrap">
                {{ $project->projectListingCount($project->id) }}
            </td>

            <td class="px-2 py-2 whitespace-nowrap">
                {{ $project->companies->name ?? 'Null' }}
            </td>

            <td class="px-2 py-2 whitespace-nowrap">
                {{ $project->getFormattedPriceAttribute($project->price_from) }}
            </td>

            <td class="px-2 py-2 whitespace-nowrap">
                 {{ $project->getFormattedPriceAttribute($project->price_to) }}
            </td>

            <td class="px-2 py-2 whitespace-nowrap ">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $project->featured == 1 ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }}">{{ $project->featured == 1 ? 'Yes' : 'No' }}</span>
            </td>

            <td class="px-2 py-2 whitespace-nowrap ">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $project->status == 'active' ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }}">
                    @foreach ( __('global.project.status') as $val => $name )
                        {{ $project->status == $val ? $name : '' }}
                    @endforeach
                    </span>
            </td>

            <td class="px-2 py-2 whitespace-nowrap text-right text-sm font-medium">
                <a href="/corporate/projects/project/{{$project->id}}" class="text-indigo-600 hover:text-indigo-900" target="_blank"><i class="fas fa-eye"></i></a> /
                <a href="project/{{ $project->id }}/edit" class="text-realty hover:text-realty-dark"><i class="fas fa-edit"></i></a>
            </td>
        </tr>
        @endforeach
    </x-backend.dynamic-table>

    <div class="flex flex-col justify-center mt-4">
        {!! $projects->links() !!}
    </div>
</div>
