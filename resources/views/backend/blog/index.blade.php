<x-backend.layout>

    <header class="flex justify-between mb-5">
        <div>
            <h1 class="text-3xl font-bold">{{ __('global.blog.blogs') }}</h1>
        </div>
        <div>
            <x-button-href href="{{ route('bk-blog-create') }}">{{ __('global.blog.create') }}</x-button-href>
        </div>
    </header>

    <hr />

    

    <!-- Listings Table -->
    <x-backend.table>
        @foreach($blogs as $i => $blog)
            <x-backend.table-tr class="{{ $i % 2 ?: 'bg-blue-50' }}" :listing="$listing" :images="$listing->images">
            </x-backend.table-tr>
        @endforeach
    </x-backend.table>

    <div class="flex flex-col justify-center">
        {!! $blogs->links() !!}
    </div>

</x-backend.layout>
