<button {{ $attributes->merge(['class'=>"bg-transparent border border-gray-500 focus:outline-none font-bold hover:bg-blue-500 hover:border-indigo-500 hover:text-white m-2 modal-open px-4 py-2 rounded text-gray-500 text-sm"]) }}>
    {{ $slot }}
</button>