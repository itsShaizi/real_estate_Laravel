<div>
    <x-alert-message :timer="true" />

    <div x-data="{ open: @entangle('showEditSection') }" class="mt-2">
        <div x-show="open == false" class="flex justify-end" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100">
            <x-button class="flex space-x-2" wire:click="new">
                <x-icons.plus /><span>New Address</span></x-button>
        </div>

        <x-backend.section x-show="open == true" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100">
            <x-slot name="title">
                <div class="flex justify-between items-center">
                    <span>{{ $sectionTitle }}</span>
                    <span @click="open = ! open"  @keyup.escape.window="open = false">
                        <svg class="fill-current h-7 w-7 text-white" role="button" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <title>Close</title>
                            <path
                                d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </span>
                </div>
            </x-slot>

            <div class="grid grid-cols-1 gap-3 sm:grid-cols-3 md:grid-cols-4">

                <div>
                    <x-label>Address Type *</x-label>
                    <x-select wire:model="editing.address_type">
                        <option value="">Select an Address Type...</option>
                        @foreach ( __('global.addresses.address_type') as $key => $value )
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="editing.address_type" />
                </div>
                <div>
                    <x-label>Select Country *</x-label>
                    <x-select wire:model="editing.country_id">
                        <option value="">Select a Country...</option>
                        @foreach ( $countries as $country )
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="editing.country_id" />
                </div>
                <div>
                    <x-label>Select State *</x-label>
                    <x-select wire:model="editing.state_id">
                        <option value="">Select a State...</option>
                        @if(!is_null($states))
                        @foreach ( $states as $state )
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                        @endif
                    </x-select>
                    <x-input-error for="editing.state_id" />
                </div>
                <div>
                    <x-label>City *</x-label>
                    <x-input type="text" wire:model.lazy="editing.city" placeholder="City..."></x-input>
                    <x-input-error for="editing.city" />
                </div>
                <div class="md:col-span-3">
                    <x-label>Address *</x-label>
                    <x-input type="text" wire:model.lazy="editing.address" placeholder="Address..."></x-input>
                    <x-input-error for="editing.address" />
                </div>
                <div>
                    <x-label>Zip *</x-label>
                    <x-input type="text" wire:model.lazy="editing.zip" placeholder="Zip..."></x-input>
                    <x-input-error for="editing.zip" />
                </div>
            </div>
            <div class="flex justify-end my-3 md:mb-3">
                <div>
                    <x-button wire:click="save">Save Address</x-button>
                </div>
            </div>
        </x-backend.section>
    </div>

    <x-backend.dynamic-table :headers="['Address','Address Type','Country','State','City','Zip','Edit']">

        @forelse($user->addresses as $address)

        <tr class="text-sm hover:bg-blue-200">
            <td class="px-2 py-2 whitespace-nowrap">{{ $address->address }} @if($address->main == 1) <span
                    class="text-realty hover:text-realty-dark"><i class="fas fa-star"></i></span> @endif</td>
            <td class="px-2 py-2 whitespace-nowrap">{{ __('global.addresses.address_type')[$address->address_type] }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap">{{ $address->country->name }}</td>
            <td class="px-2 py-2 whitespace-nowrap">{{ $address->state->name }}</td>
            <td class="px-2 py-2 whitespace-nowrap">{{ $address->city }}</td>
            <td class="px-2 py-2 whitespace-nowrap">{{ $address->zip }}</td>
            <td class="px-2 py-2 whitespace-nowrap">
                <div class="flex space-x-2">
                    <button wire:click="edit({{ $address->id }})" class="text-realty hover:text-realty-dark"><i
                            class="fas fa-edit"></i></button>

                    <button type="button" wire:click="remove({{ $address->id }})"
                        class="text-realty hover:text-realty-dark">
                        <i class="fas fa-trash"></i>
                    </button>

                    @if ($address->main != 1)
                    <button type="button" wire:click="setMain({{ $address->id }})"
                        class="text-realty hover:text-realty-dark">
                        <span class="fas fa-star"></span>
                    </button>
                    @endif
                </div>
            </td>
        </tr>

        @empty

        <tr>
            <td colspan="7" class="text-base text-center py-4">No addresses added.</td>
        </tr>

        @endforelse
    </x-backend.dynamic-table>
</div>
