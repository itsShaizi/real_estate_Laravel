@props([ 'disabled' => false, 'icon' => false, 'iconSign' => '', 'iconPosition' => 'left', 'alignIcon' => ''])

@php
switch ($icon) {
    case 'dollar':
        $iconSign = 'fa-dollar-sign';
        break;
    case 'euro':
        $iconSign = 'fa-euro-sign';
        break;
    case 'user':
        $iconSign = 'fa-user-alt';
        break;
    case 'percent':
        $iconSign = 'fa-percentage';
        break;
    case 'calendar':
        $iconSign = 'fa-calendar-alt';
        break;
    default:
        $iconSign = '';
        break;
}

switch ($iconPosition) {
    case 'right':
        $alignIcon = 'rounded-r';
        break;
    default:
        $alignIcon = 'rounded-l';
        break;
}
@endphp

<div class="flex items-center">
    @if ($icon && $iconPosition == 'left')
        <span class="fas {{ $iconSign }} px-5 py-2 bg-gray-200 {{ $alignIcon }} text-gray-400"></span>
    @endif
    <input {{ $disabled ? 'disabled' : '' }} {{ $attributes }} class='{{ ! $icon ? "border-l rounded-l" : "" }} {{ $iconPosition == "right" ? "border-l rounded-l" : "border-r rounded-r" }} border-b-2 border-t-2 focus:border-indigo-300 focus:placeholder-opacity-0 focus:rounded my-1 outline-none p-1 pl-3 placeholder-gray-500 placeholder-opacity-40 shadow-sm text-sm w-full'>
    @if ($icon && $iconPosition == 'right')
        <span class="fas {{ $iconSign }} px-5 py-2 bg-gray-200 {{ $alignIcon }} text-gray-400"></span>
    @endif
</div>