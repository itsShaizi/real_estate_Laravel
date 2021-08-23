<button {{ $attributes->merge(['type' => 'submit', 'class' => 'active:bg-red-600 bg-red-600 border border-transparent disabled:opacity-25 duration-150 ease-in-out focus:border-gray-900 hover:bg-red-700 items-center px-4 py-2 rounded-full text-white transition']) }}>
    {{ $slot }}
</button>
