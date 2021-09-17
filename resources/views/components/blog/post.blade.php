@if(!empty($blogs->count()))
@if(isset($searchbar))
    @foreach($blogs as $blog)

        <x-blog.feature-blog :blog="$blog" :searchbar="$searchbar"></x-blog.feature-blog>
        @break
    @endforeach
@else
    @foreach($blogs as $blog)

        <x-blog.feature-blog :blog="$blog" ></x-blog.feature-blog>
        @break
    @endforeach
    @endif
@endif


<div class="grid grid-col-1 md:grid-cols-2 lg:grid-cols-3 pt-12">
    @php $first_post = false; @endphp
    @foreach($blogs as $blog)
        @if(!$first_post)
            @php $first_post = true; @endphp
            @continue
        @endif
    <div class="w-full p-6 flex flex-col flex-grow flex-shrink group">
        <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-none">
            <a href="{{ route('sd-blog',$blog->slug) }}" class="flex flex-wrap no-underline hover:no-underline">

                <div class="flex justify-center w-full">
                    <div>
                        <img
                            src="{{  url(!empty($blog->cover_image) ? '/storage/blogs/images/' . $blog->id . '/thumb/' .$blog->cover_image->title : '/images/resources/no-image-yellow.jpg') }}"
                            class="h-64 w-full rounded-t pb-6 group-hover:opacity-25"
                        />
                    </div>
                    <div class="absolute opacity-0 fd-sh group-hover:opacity-100 h-64 items-center justify-center">
                        <i class="fa fa-share text-gray-200 rounded-full bg-blue-400 p-5 mt-24"></i>
                    </div>
                </div>

                <div class="w-full font-bold text-xl text-gray-900 px-6">
                    {{ $blog->title }}
                </div>
                <p class="text-gray-800 font-serif text-base px-6 mb-5">
                    {!! Str::limit(strip_tags($blog->content),50,' ...')!!}
                </p>
            </a>
        </div>

        <div
            class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-none p-6">
            <div class="flex justify-space">
                <p class="text-gray-600 text-xs md:text-sm">{{ date('F j, Y',strtotime($blog->created_at)) }}</p>
                <p class="text-gray-600 text-xs md:text-sm pr-2">/</p>
                <p class="text-gray-600 text-xs md:text-sm pr-2">{{ $blog->author->first_name }}</p>

            </div>
        </div>
    </div>
    @endforeach
</div>
