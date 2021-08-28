@props([
    'route' => '#',
    'formId' => 'delete-model-1',
    'label' => 'Delete',
    'submitLabel' => 'Delete',
    'triggerButton' => 'Delete',
    'modalTitle' => 'Delete',
    'modalDescription' => 'Delete',
])

<div class="p-2">
    <x-label>{{ $label }}</x-label>
    <div class="flex flex-col md:flex-row md:justify-between items-center">
        <p>{{ $description }}</p>
        <div x-data="{ on : false }">
            <form action="{{ $route }}" method="POST"
                id="{{ $formId }}">
                @csrf
                @method('DELETE')
                <x-confirm submitLabel="{{ $submitLabel }}" form="{{ $formId }}">
                    <x-slot name="trigger">
                        <x-button-red x-on:click.prevent="on = ! on" class="whitespace-nowrap ml-4">{{ $triggerButton }}</x-button-red>
                    </x-slot>
                    <x-slot name="title">{{ $modalTitle }}</x-slot>

                    <p>{{ $modalDescription }}</p>
                </x-confirm>
            </form>
        </div>
    </div>
</div>
