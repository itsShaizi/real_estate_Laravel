<button {{ $attributes->merge(['class' => 'active:bg-red-500 bg-red-400 disabled:opacity-25 duration-150 ease-in-out hover:bg-red-600 items-center px-4 py-2 rounded-full text-white transition']) }}>
    {{ $slot }}
</button>
