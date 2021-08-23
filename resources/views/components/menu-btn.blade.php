<button {{ $attributes->merge(['type' => 'submit', 'class' => 'border font-light px-4 py-2 rounded-md text-base tracking-widest uppercase']) }}>
    {{ $slot }}
</button>