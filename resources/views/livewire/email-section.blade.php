<div>
    <x-alert-message :timer="true" />
    <x-alert-error-message :timer="true" />

    <div x-data="{ open: @entangle('showEditSection') }" class="mt-2">
        <div x-show="open == false" class="flex justify-end"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100">
            <x-button class="flex space-x-2" wire:click="new">
                <x-icons.plus /><span>Add Email</span></x-button>
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
                    <x-label>Email Type *</x-label>
                    <x-select wire:model="editing.email_type">
                        <option value="">Select a Email Type...</option>
                        @foreach ( __('global.emails.email_type') as $key => $value )
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="editing.email_type" />
                </div>
                <div class="md:w-1/2">
                    <x-label>Email</x-label>
                    <x-input type="email" wire:model.debounce.defer="editing.email" placeholder="Email..." wire:keydown.enter="save">
                    </x-input>
                    <x-input-error for="editing.email" />
                </div>
            </div>
            <div class="flex justify-end my-3 md:mb-3">
                <div>
                    <x-button wire:click="save">Save Email</x-button>
                </div>
            </div>
        </x-backend.section>
    </div>

    <x-backend.dynamic-table :headers="['email','Email Type','Edit']">

        @forelse($user->emails as $email)

        <tr class="text-sm hover:bg-blue-200">
            <td class="p-3 whitespace-nowrap">{{ $email->email }} @if($email->main == 1) <span
                    class="text-realty hover:text-realty-dark"><i class="fas fa-star"></i></span> @endif</td>
            <td class="p-3 whitespace-nowrap">{{ __('global.emails.email_type')[$email->email_type] }}</td>
            <td class="p-3 whitespace-nowrap">
                <div class="flex space-x-2">
                    <button wire:click="edit({{ $email->id }})" class="text-realty hover:text-realty-dark"><i
                            class="fas fa-edit"></i></button>

                    @if($user->email != $email->email)
                    <button type="button" wire:click="remove({{ $email->id }})" class="text-realty hover:text-realty-dark">
                        <i class="fas fa-trash"></i>
                    </button>
                    @endif

                    @if ($email->main != 1)
                    <button type="button" wire:click="setMain({{ $email->id }})"
                        class="text-realty hover:text-realty-dark">
                        <span class="fas fa-star"></span>
                    </button>
                    @endif
                </div>
            </td>
        </tr>

        @empty

        <tr>
            <td colspan="7" class="text-base text-center py-4">No Emails added.</td>
        </tr>

        @endforelse
    </x-backend.dynamic-table>
</div>
