<div class="h-full bg-white rounded overflow-hidden shadow-lg">
    <a
        href="#"
        class="flex flex-col flex-wrap no-underline hover:no-underline"
    >
        <div class="w-full rounded-t">
            <img
                src="{{  url(!empty($blog->cover_image) ? '/storage/blogs/images/' . $blog->id . '/thumb/' .$blog->cover_image->title : '/images/resources/no-image-yellow.jpg') }}"
                class="h-96 w-full shadow object-cover"
            />
        </div>

        <div class="w-full flex flex-col flex-grow flex-shrink">
            <div
                class="
                    flex-1
                    bg-white
                    rounded-t rounded-b-none
                    overflow-hidden
                    shadow-lg
                    space-y-1
                    pb-5
                  "
            >
                <p class="w-full text-gray-600 text-xs md:text-sm pt-6 px-6">
                    <p class="text-gray-600 text-xs md:text-sm">{{ $blog->author->first_name }}</p>
                    <p class="text-gray-600 text-xs md:text-sm">{{ $blog->created_at }}</p>
                </p>
                <div class="w-full font-bold text-xl text-gray-900 px-6">
                    {{ $blog->title }}
                </div>
                <p class="text-gray-800 font-serif text-base px-6 mb-5">
                    {!! Str::limit(strip_tags($blog->content),50,' ...')!!}
                </p>
            </div>
        </div>
    </a>
</div>
