<div class="grid grid-col-1 md:grid-cols-2 lg:grid-cols-3 pt-12 -mx-6">
    @foreach($blogs as $blog)
    <div class="w-full p-6 flex flex-col flex-grow flex-shrink">
        <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
            <a href="{{ route('sd-blog',$blog->slug) }}" class="flex flex-wrap no-underline hover:no-underline">
                <img src="{{  url(!empty($blog->cover_image) ? '/storage/blogs/images/' . $blog->id . '/thumb/' .$blog->cover_image->title : '/images/resources/no-image-yellow.jpg') }}" class="h-64 w-full rounded-t pb-6"/>
                <div class="w-full font-bold text-xl text-gray-900 px-6">
                    {{ $blog->title }}
                </div>
                <p class="text-gray-800 font-serif text-base px-6 mb-5">
                    {!! Str::limit(strip_tags($blog->content),50,' ...')!!}
                </p>
            </a>
        </div>

        <div
            class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
            <div class="flex items-center justify-between">
                <p class="text-gray-600 text-xs md:text-sm">{{ $blog->author->first_name }}</p>
                <p class="text-gray-600 text-xs md:text-sm">{{ $blog->created_at }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
