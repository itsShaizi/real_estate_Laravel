<x-backend.layout>
    <header class="flex justify-between mb-5">
        <div>
            <h1 class="text-3xl font-bold"><span x-text="create"></span> Blog Post</h1>
        </div>
        <div>
            <x-button-href class="bg-red-200" href='{{ route("bk-blogs") }}'>Back</x-button-href>
        </div>
    </header>
<div class="container mx-auto flex flex-wrap py-6">
    
    <!-- Post Section -->
    <section class="w-full md:w flex flex-col items-center px-3">

        <article class="flex flex-col shadow my-4">
            <!-- Article Image -->
            <a href="#" class="hover:opacity-75">
                <img src="{{  url(!empty($blog->cover_image) ? '/storage/blogs/images/' . $blog->id . '/thumb/' .$blog->cover_image->title : '/images/resources/no-image-yellow.jpg') }}">
            </a>
            <div class="bg-white flex flex-col justify-start p-6">
                @if(!empty($blog->tags->count()))
                <div class="grid grid-cols-12">
                    @foreach($blog->tags as $tag)
                            <div>
                                <span class="px-2 py-1 text-white font-bold leading-none text-white bg-realty rounded-full">
                                    {{ trim($tag->content) }}
                                </span>
                            </div>
                    @endforeach
                </div>
                @endif
                <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $blog->title }}</a>
                <p href="#" class="text-sm pb-8">
                    By <span class="font-semibold hover:text-gray-800">{{ $blog->author->first_name.' '.$blog->author->last_name}}</span>, Published on {{ date("F j, Y",strtotime($blog->created_at)) }}
                </p>
                <div>
                    {!! $blog->content !!}
                </div>
            </div>
        </article>

    </section>


</div>
</x-backend.layout>