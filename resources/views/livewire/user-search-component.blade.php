<div
    x-data="{ show : false }"
    x-on:click.away="show = false"
    class="relative z-50"
    @user-selected.window="show = false"
>
    <x-input
        x-on:focus="show = true"
        x-on:focusout.debounce="show = false"
        x-on:keydown.backspace="show = true"
        wire:model.debounce.500ms="query"
        wire:keydown.arrow-up="decrementHighlight"
        wire:keydown.arrow-down="incrementHighlight"
        wire:keydown.enter.prevent="selectWithEnter"
    />
    {{-- 
        This input hidden is for normal form process (non-livewire / ajax)
        So after submiting the form, we can grab the selected value from the component
    --}}
    <input type="hidden" name="{{ $name }}" value="{{ $selected }}">
    <template x-if="show">
        <ul
            role="listbox"
            x-show.transition="show"
            class="border border-gray-300 mt-1 absolute rounded-lg bg-white max-h-64 w-full overflow-auto"
        >
            @forelse ($users as $i => $user)
                <li
                    role="option"
                    aria-role="button"
                    x-on:click="show = false"
                    wire:click="select('{{ $user->id }}')"
                    @class([
                        'pl-4 py-2 cursor-pointer hover:bg-realty hover:text-white',
                        'bg-realty text-white' => $highlightIndex == $i
                    ])
                >
                    {{ $user->first_name }} {{ $user->last_name }}
                </li>
            @empty
                <p class="hover:bg-realty hover:text-white cursor-pointer pl-4 py-2">
                    @if ($query && !$selected)
                        No results for {{ $query }}
                    @else
                        Search...
                    @endif
                </p>
            @endforelse
        </ul>
    </template>
</div>
