<div class="realtive">
    <select {{ $attributes }} class='mt-2 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent flex-1'>
        {{ $slot }}
    </select>
    <span class="fa fa-chevron-down absolute mt-5 -ml-6 text-gray-500" aria-hidden="true"></span>
</div>
