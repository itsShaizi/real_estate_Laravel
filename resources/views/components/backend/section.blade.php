<div class="border flex flex-col rounded mt-2" {{ $attributes }}>
    <header class="bg-gradient-to-r from-gray-600 via-gray-400 to-blue-400 rounded-t uppercase text-white px-3 py-2 text-sm md:text-base md:px-5 md:py-3">{{ $title }}</header>
    <content {{ $attributes->merge(['class' => 'p-2 md:p-5']) }}>
        {{ $slot }}
    </content>
</div>