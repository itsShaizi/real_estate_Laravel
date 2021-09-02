<x-blog.layout>
    <!--Container-->
    <div class="container px-4 md:px-0 max-w-6xl pt-16 mx-auto -mt-20">
        <div class="mx-0 sm:mx-6">
            <!--Nav-->
            <div class=" bg-gray-200 w-full text-xl md:text-2xl text-gray-800 leading-normal rounded-t my-4">
                <style>
                    .smooth {
                        transition: box-shadow 0.3s ease-in-out;
                    }
                    ::selection {
                        background-color: aliceblue;
                    }
                </style>
                <!--Title-->
                <div class="text-center pt-5 md:pt-10">
                    <p class="text-sm md:text-base text-green-500 font-bold">
                        {{ $blog->author->first_name }}&nbsp;{{ $blog->author->last_name }} <span class="text-gray-900">/</span> {{ $blog->created_at }}
                    </p>
                    <h1 class="font-bold break-normal text-3xl md:text-5xl">
                        {{ $blog->title }}
                    </h1>
                </div>

                <!--image-->
                <div class="container w-full max-w-6xl mx-auto bg-white bg-cover mt-8 rounded" style="background-image: url({{  !empty($blog->cover_image) ? '/storage/blogs/images/' . $blog->id . '/original/' .$blog->cover_image->title : '/images/resources/no-image-yellow.jpg' }}); height: 75vh;">
                </div>

                <!--Container-->
                <div class="container max-w-5xl mx-auto -mt-32">
                    <div class="mx-0 sm:mx-6">
                        <div class="bg-white w-full p-8 md:p-24 text-xl md:text-2xl text-gray-800 leading-normal">
                            {!! $blog->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-blog.layout>
