@props([
    'image' => null,
    'temporaryPath' => 'api/temp-avatar-uploader',
    'name' => 'avatar',
])

<div
    x-data="{edit: false}"
    x-init="() =>
        {
        @if(!$image)
            edit = true
        @endif
        }"
    class="p-2 flex lg:flex-col items-start"
>
@if ($image)
<div x-show="!edit" class="relative">
    <x-button-warning type="button" x-on:click="edit = true"
        class="absolute cursor-pointer right-0 bottom-0 opacity-50 hover:opacity-100">
        <x-icons.pencil />
    </x-button-warning>
    <img src="{{ $image }}" class="w-36 h-36 rounded-full object-cover">
</div>
@endif
    <div x-show="edit" class="relative">
        <x-button-danger type="button" x-on:click="edit = false" class="absolute cursor-pointer right-0 bottom-0 opacity-50 hover:opacity-100 z-50">
            x
        </x-button-danger>
        <x-filepond
        class="w-36 h-36 -mt-2"
        name="{{ $name }}"
        avatar-style uploadUrl="{{ url($temporaryPath) }}"
        file-size-validation="2MB"
        file-type-validation="image/*"
        correct-image-orientation
        crop-aspect-ratio="1:1"
        />
    </div>
</div>
