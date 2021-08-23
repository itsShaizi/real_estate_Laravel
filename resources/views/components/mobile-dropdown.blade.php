@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white'])

@php
switch ($align) {
    case 'left':
        $alignmentClasses = 'origin-top-left left-0';
        break;
    case 'top':
        $alignmentClasses = 'origin-top';
        break;
    case 'right':
    default:
        $alignmentClasses = 'origin-top-right right-0';
        break;
}

switch ($width) {
    case '48':
        $width = 'w-48';
        break;
}
@endphp

<div class="relative" x-data="{ on: false }">
    <div @click="on = !on" class="ml-5 py-5 text-left">
        {{ $trigger }} 
    </div>

    <div x-show="on"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="bg-white origin-top rounded-md shadow-lg w-full z-50 {{ $alignmentClasses }}"
            style="display: none;"
            @click="on = false">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 text-left {{ $contentClasses }}">
            {{ $content ?? '' }}
        </div>
    </div>
</div>