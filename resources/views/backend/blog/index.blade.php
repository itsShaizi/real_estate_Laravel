<x-backend.layout>

    <header class="flex justify-between mb-5">
        <div>
            <h1 class="text-3xl font-bold">{{ __('global.blog.blogs') }}</h1>
        </div>
        <div>
            <x-button-href href="{{ route('sd-blogs') }}" target="_blank">Go to Blog</x-button-href>
        </div>
        <div>
            <x-button-href href="{{ route('bk-blog-create') }}">{{ __('global.blog.create') }}</x-button-href>
        </div>
    </header>

    <hr />

    <livewire:blog.search />

</x-backend.layout>
