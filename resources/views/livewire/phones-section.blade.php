<div>
    <x-alert-message  :timer="true" />

    <div x-data="{ open: @entangle('showEditSection') }" class="mt-2">
        <div x-show="open == false" class="flex justify-end"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100">
            <x-button class="flex space-x-2" wire:click="newPhone">
                <x-icons.plus /><span>Add Phone</span></x-button>
        </div>

        <x-backend.section x-show="open == true"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100">
            <x-slot name="title">
                <div class="flex justify-between items-center">
                    <span>{{ $sectionTitle }}</span>
                    <span @click="open = ! open" @keyup.escape.window="open = false">
                        <svg class="fill-current h-7 w-7 text-white" role="button" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <title>Close</title>
                            <path
                                d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </span>
                </div>

            </x-slot>

            <div class="flex flex-col md:flex-row md:space-x-4">
                <div>
                    <x-label>Phone Type *</x-label>
                    <x-select wire:model="editing.phone_type">
                        <option value="">Select a Phone Type...</option>
                        @foreach ( __('global.phones.phone_type') as $key => $value )
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="editing.phone_type" />
                </div>
                <div>
                    <x-label>Country Code *</x-label>
                    <x-select wire:model="editing.country_code">
                        <option value="">Select...</option>
                        @foreach ( $countries->sortBy('iso2') as $country )
                        <option value="{{ $country->iso2 }}">{{ $country->iso2 }} ({{ $country->phonecode }})</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="editing.country_code" />
                </div>
                <div>
                    <x-label>Phone Number *</x-label>
                    <div class="flex flex-col space-x-4">
                        <x-input type="text" wire:model.debounce.1000ms="editing.number" placeholder="Phone Number...">
                        </x-input>
                    </div>
                    <x-input-error for="editing.number" />
                </div>
                <div>
                    <x-label>Phone Number Extension</x-label>
                    <div class="flex space-x-4">
                        <x-input type="text" wire:model.debounce.1000ms="editing.number_ext"
                            placeholder="Phone Number Extension...">
                        </x-input>
                        <x-input-error for="editing.number_ext" />
                    </div>
                </div>
            </div>
            <div class="flex justify-end my-3 md:mb-3">
                <div>
                    <x-button wire:click="save">Save Phone</x-button>
                </div>
            </div>
        </x-backend.section>
    </div>

    <x-backend.dynamic-table :headers="['Phone Number','Country Code','Country Code Number','Extension','Phone Type','Edit']" >

        @forelse($user->phones as $phone)

        <tr class="text-sm hover:bg-blue-200">
            <td class="px-2 py-2 whitespace-nowrap">{{ $phone->number }} @if($phone->main == 1) <span
                    class="text-realty hover:text-realty-dark"><i class="fas fa-star"></i></span> @endif</td>
            <td class="px-2 py-2 whitespace-nowrap">{{ $phone->country_code }}</td>
            <td class="px-2 py-2 whitespace-nowrap">{{ $phone->country_code_num }}</td>
            <td class="px-2 py-2 whitespace-nowrap">{{ $phone->number_ext }}</td>
            <td class="px-2 py-2 whitespace-nowrap">{{ __('global.phones.phone_type')[$phone->phone_type] }}</td>
            <td class="px-2 py-2 whitespace-nowrap">
                <div class="flex space-x-2">
                    <button wire:click="edit({{ $phone->id }})" class="text-realty hover:text-realty-dark"><i
                            class="fas fa-edit"></i></button>

                    <button type="button" wire:click="remove({{ $phone->id }})" class="text-realty hover:text-realty-dark">
                        <i class="fas fa-trash"></i>
                    </button>

                    @if ($phone->main != 1)
                    <button type="button" wire:click="setMain({{ $phone->id }})"
                        class="text-realty hover:text-realty-dark">
                        <span class="fas fa-star"></span>
                    </button>
                    @endif
                </div>
            </td>
        </tr>

        @empty

        <tr>
            <td colspan="7" class="text-base text-center py-4">No phones added.</td>
        </tr>

        @endforelse
    </x-backend.dynamic-table>
</div>
