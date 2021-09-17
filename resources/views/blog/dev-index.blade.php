<x-blog.layout>


    <x-blog.category-header-two :categories="$categories"></x-blog.category-header-two>


    <span>

            <div id="latestbuz" class="go_to_left tabContent  container px-4 md:px-0 max-w-6xl mx-auto">
                <div class="mx-0 sm:mx-6">
                    <div class=" bg-white w-full text-xl md:text-2xl text-gray-800 leading-normal rounded-t my-4">


                        <x-blog.post :blogs="$blogs"></x-blog.post>
                        <!-- pagination -->
                        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                            {!! $blogs->links() !!}
                        </div>
                    </div>
            </div>
        </div>

               @if(!empty($categories))

                    @foreach ($categories as $key3 => $category)

                        <div id="{{$key3.Str::slug($category->name)}}" class="hidden go_to_left tabContent  container px-4 md:px-0 max-w-6xl mx-auto">
                                <div class="mx-0 sm:mx-6">
                                    <div class=" bg-white w-full text-xl md:text-2xl text-gray-800 leading-normal rounded-t my-4">

                                        <x-blog.post :blogs="$category->blogs"></x-blog.post>

                                    </div>
                            </div>
                        </div>

                   @endforeach
               @endif
    </span>

</x-blog.layout>
