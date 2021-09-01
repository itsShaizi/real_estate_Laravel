<x-backend.section title="Notes">
    <x-alert-message />
    <div class="mt-2">
        <x-label>
            New note
        </x-label>
        <x-textarea
            wire:model.defer="new_note"
            rows="2"
        />
        <div class="flex items-center space-x-4">
            <x-button type="button" wire:click="saveNote">Save Note</x-button>
            <x-input-error for="new_note" />
        </div>
    </div>

    <div class="mt-4">
        <div 
            x-data="{ selected:null }"
            class="bg-white mx-auto border border-gray-200 rounded"
        >
            <ul class="shadow-box">
                @foreach ($listing_notes as $note)
                    <li class="relative border-b border-gray-200">
                        <div class="px-4 py-2 flex justify-between items-center">
                            <button
                                type="button"
                                wire:click="$set('update_note', '{{ $note->notes }}')"
                                class="w-full flex text-left "
                                @click="selected !== {{ $loop->index }} ? selected = {{ $loop->index }} : selected = null"
                            >
                                <span x-show="selected !== {{ $loop->index }}" class="text-realty mr-2">
                                    <i class="fas fa-plus-circle"></i>
                                </span>
                                <span x-show="selected === {{ $loop->index }}" class="text-realty mr-2">
                                    <i class="fas fa-minus-circle"></i>
                                </span>
                                <span class="whitespace-nowrap">
                                    {{ $note->created_at->format('m-d-Y g:ia') }}:
                                    {{ $note->user->first_name ?? '' }} 
                                    {{ $note->user->last_name ?? '' }}
                                </span>
                            </button>
                            <button
                                type="button"
                                wire:click="delete('{{ $note->id }}')"
                                class="text-realty hover:text-realty-dark"
                            >
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div 
                            class="relative overflow-hidden transition-all max-h-0 duration-300" 
                            x-ref="container{{ $loop->index }}" 
                            x-bind:style="selected == {{ $loop->index }} ? 'max-height: ' + $refs.container{{ $loop->index }}.scrollHeight + 'px' : ''"
                        >
                            <div class="px-4 mb-2">
                                @isset($note->data)
                                    <div class="-mt-4">
                                        <x-backend.dynamic-table :headers="['Field', 'Old Value', 'New Value']">
                                            @foreach ($note->data as $data)
                                                <tr class="text-sm hover:bg-blue-200">
                                                    <td class="px-2 py-2 whitespace-nowrap">
                                                        {{ $data['field'] }}
                                                    </td>
                                                    <td class="px-2 py-2">
                                                        {{ $data['old_value'] }}
                                                    </td>
                                                    <td class="px-2 py-2">
                                                        {{ $data['new_value'] }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </x-backend.dynamic-table>
                                    </div>
                                @endisset
                                <div class="mt-2">
                                    <x-label>
                                        Update note
                                    </x-label>
                                    <x-textarea
                                        wire:model.defer="update_note"
                                        rows="2"
                                    />
                                    <div class="flex items-center space-x-4">
                                        <x-button type="button" wire:click="updateNote('{{ $note->id }}')">
                                            Update Note
                                        </x-button>
                                        <x-input-error for="update_note" />
                                    </div>
                                </div>
                                <p></p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-backend.section>
