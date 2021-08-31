<tr {{ $attributes->merge(['class' => 'text-sm hover:bg-blue-200']) }}>
    <td class="text-base px-2 py-2">
        <div class="flex items-center">
            <div class="w-20 h-20 bg-cover bg-center" style="background-image: url({{  !empty($blog->cover_image) ? '/storage/blogs/images/' . $blog->id . '/thumb/' .$blog->cover_image->title : '/images/resources/no-image-yellow.jpg' }})"></div>
        </div>
    </td>
    <td class="px-2 py-2 whitespace-nowrap">
        {{ $blog->title }}
    </td>
    <td class="px-2 py-2 whitespace-nowrap">
        {{ Str::limit($blog->content,20,' ...')}}
    </td>
    <td class="px-2 py-2 whitespace-nowrap">
        @if(!empty($blog->tags->count()))
            @foreach($blog->tags as $tag)
                <span class="active:bg-realty bg-realty border border-transparent disabled:opacity-25 duration-150 ease-in-out focus:border-gray-900 hover:bg-realty-dark items-center px-2 py-1 rounded-full text-white transition h-8 text-sm">
                    {{ trim($tag->content) }}
                </span>
            @endforeach
        @endif
    </td>
    <td class="px-2 py-2 whitespace-nowrap">
        {{ $blog->author->first_name.' '.$blog->author->last_name}}
    </td>
    <td class="px-2 py-2 whitespace-nowrap text-right text-sm font-medium">
        {{-- <a href="/blog/{{ $blog->id }}" class="text-indigo-600 hover:text-indigo-900" target="_blank">View</a> --}}
         {{-- / --}}
        {{-- <a href="blog/{{ $blog->id }}/edit" class="text-indigo-600 hover:text-indigo-900">Edit</a> --}}
        <div class="flex justify-left">
            <div class="mt-2.5">
                <x-button-href href="blog/{{ $blog->id }}/edit">Edit</x-button-href>
            </div>
            <div x-data="{ on : false }">
                <form action="blog/{{ $blog->id }}/delete" method="POST"
                    id="delete-blog-{{ $blog->id }}">
                    @csrf
                    @method('DELETE')
                    <x-confirm submitLabel="Delete Blog" form="delete-blog-{{ $blog->id }}">
                        <x-slot name="trigger">
                            <x-button-red x-on:click.prevent="on = ! on" class="whitespace-nowrap ml-4">Delete
                            </x-button-red>
                        </x-slot>
                        <x-slot name="title">Delete Blog</x-slot>

                        <p>This will permanently delete this blog post.</p>
                    </x-confirm>
                </form>
            </div>
        </div>
    </td>
</tr>
