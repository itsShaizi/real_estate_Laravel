<div class="mt-10">
    <div class="grid gap-4 place-items-center grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
        @forelse ($images as $image)
            <div class="relative">
                <x-button-danger
                    type="button"
                    wire:click="deleteImage('{{ $image->id }}')"
                    class="absolute cursor-pointer right-1 bottom-1 opacity-25 hover:opacity-100"
                >
                    x
                </x-button-danger>
                <img 
                    src="{{ $image->image_thumb_path }}"
                    class="rounded shadow-lg"
                >
            </div>
        @empty
            <p>No images yet.</p>
        @endforelse
    </div>
</div>