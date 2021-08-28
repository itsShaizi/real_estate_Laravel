<x-backend.section title="Contacts">
    <x-alert-message />
    <div class="grid gap-4 md:grid-cols-5 mt-2">
        <div class="col-span-2">
            <x-label>
                Group
            </x-label>
            <x-select wire:model.defer="group_id">
                <option value="">Select...</option>
                @foreach ($groups as $key => $value)
                    <option value="{{ $key }}">
                        {{ $value }}
                    </option>
                @endforeach
            </x-select>
        </div>
        <div class="col-span-2">
            <x-label>
                Contact
            </x-label>
            <div wire:ignore>
                <livewire:user-search-component name="contact_id" />
            </div>
        </div>
        <div class="grid place-content-end">
            <x-button type="button" wire:click="addContact">Add Contact</x-button>
        </div>
        <div class="col-span-2 -mt-3">
            <x-input-error for="group_id" />
        </div>
        <div class="col-span-2 -mt-3">
            <x-input-error for="contact_id" />
        </div>
    </div>
    <x-input-error for="contact_exists" class="-mt-3" />

    <x-backend.dynamic-table :headers="['Contact Name', 'Group Name', 'Actions']">
        @forelse ($contacts as $contact)
        <tr class="text-sm hover:bg-blue-200">
            <td class="text-base px-2 py-2">
                <div class="flex items-center">
                    @if ($contact->user->avatar)
                        <div class="flex-shrink-0 w-10 h-10">
                            <img
                                class="w-full h-full rounded-full"
                                src="{{ $contact->user->avatar }}"
                                alt="{{ $contact->user->first_name }} {{ $contact->user->last_name }}"
                            >
                        </div>
                    @endif
                    <div @class(['ml-3' => $contact->user->avatar])>
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{ $contact->user->first_name }} {{ $contact->user->last_name }}
                            @if ($contact->isMainAgent($contact->group->slug))
                                <span class="fas fa-star text-realty"></span>
                            @endif
                        </p>
                    </div>
                </div>
            </td>
            <td class="px-2 py-2 whitespace-nowrap">
                {{ $contact->group->name }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap text-sm font-medium">
                <button
                    type="button"
                    wire:click="removeContact('{{ $contact->user->id }}', '{{ $contact->group->id }}')"
                    class="text-realty hover:text-realty-dark"
                >
                    <i class="fas fa-trash"></i>
                </button>
                @if ($contact->canBeMainAgent($contact->group->slug))
                    <button
                        type="button"
                        wire:click="setMainAgent('{{ $contact->user->id }}', '{{ $contact->group->slug }}')"
                        class="text-realty hover:text-realty-dark"
                    >
                        <span class="fas fa-star"></span>
                    </button>
                @endif
            </td>
        </tr>
        @empty
            <tr class="text-sm hover:bg-blue-200">
                <td colspan="3" class="text-base px-2 py-2">
                    No contacts yet ...
                </td>
            </tr>
        @endforelse
    </x-backend.dynamic-table>
</x-backend.section>
