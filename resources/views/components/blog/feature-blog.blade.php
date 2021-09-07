<div style="max-width: 1310px" class="flex-1 relative z-0 flex overflow-hidden container mx-auto">
<div class="h-full bg-white rounded overflow-hidden shadow-lg group">
    <a href="{{ route('sd-blog',$blog->slug) }}" class="flex flex-wrap no-underline hover:no-underline">
        <div class="w-full rounded-t">
            <div class="flex justify-center w-full">
                <div class="w-full">
                    <img
                        src="{{  url(!empty($blog->cover_image) ? '/storage/blogs/images/' . $blog->id . '/thumb/' .$blog->cover_image->title : '/images/resources/no-image-yellow.jpg') }}"
                        class="h-96 w-full shadow object-cover group-hover:opacity-25"
                    />
                </div>
                <div class="absolute opacity-0 fd-sh group-hover:opacity-100 h-64 items-center justify-center">
                    <i class="fa fa-2x fa-share text-gray-200 rounded-full bg-blue-400 p-5 mt-36"></i>
                </div>
            </div>
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
            <div
                class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
                <div class="flex justify-space">
                    <p class="text-gray-600 text-xs md:text-sm pr-2">{{ $blog->author->first_name }}</p>
                    <p class="text-gray-600 text-xs md:text-sm pr-2">/</p>
                    <p class="text-gray-600 text-xs md:text-sm">{{ date('F j, Y',strtotime($blog->created_at)) }}</p>
                </div>
            </div>
                <div class="w-full font-bold text-xl text-gray-900 px-6">
                    {{ $blog->title }}
                </div>
                <p class="text-gray-800 font-serif text-base px-6 mb-5">
                    {!! Str::limit(strip_tags($blog->content),200,' ...')!!}
                </p>
            </div>
        </div>
    </a>
</div>
<aside class="hidden relative xl:flex xl:flex-col flex-shrink-0 w-96 border-l border-gray-200">
    <!-- Start secondary column (hidden on smaller screens) -->
    <div class="inset-0 py-6 px-4 sm:px-6 lg:px-8 border-gray-500">
        <div class="h-full rounded-lg space-y-16">
            <!-- search start -->

            <div class="relative">
                <input type="text" class="border border-gray-200 h-10 w-80 pl-10 pr-20 z-0 focus:shadow focus:outline-none" placeholder="Search" />
                <div class="absolute top-0 right-0">
                    <button class="h-10 w-14 text-white bg-indigo-500 hover:bg-indigo-600">
                        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End secondary column -->
</aside>
</div>
