<button {{ $attributes->merge(['class' => 'active:bg-yellow-300 bg-yellow-200 disabled:opacity-25 duration-150 ease-in-out hover:bg-yellow-400 items-center px-4 py-2 rounded-full text-white transition']) }}>
    {{ $slot }}
</button>
