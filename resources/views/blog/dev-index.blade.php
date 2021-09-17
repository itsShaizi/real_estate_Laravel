<x-blog.layout>

<span x-data="{ selected: 'option-0' }">
    <x-blog.category-header-two :categories="$categories"></x-blog.category-header-two>


    <span>

            <div id="latestbuz" x-show="selected === 'option-0'"

                 x-transition:enter="transition duration-1000"
                 x-transition:enter-start="transform translate-x-full"
                 x-transition:enter-end="transform translate-x-0"
                 x-transition:leave="transition duration-1000"
                 x-transition:leave-start="transform"
                 x-transition:leave-end="transform -translate-x-full"

                 class="container px-4 md:px-0 max-w-6xl mx-auto">
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

                        <div id="{{$key3.Str::slug($category->name)}}" x-show="selected === 'option-{{$key3+1}}'"
                             x-transition:enter="transition duration-1000"
                             x-transition:enter-start="transform translate-x-full"
                             x-transition:enter-end="transform translate-x-0"
                             x-transition:leave="transition duration-1000"
                             x-transition:leave-start="transform"
                             x-transition:leave-end="transform -translate-x-full"

                             class="container px-4 md:px-0 max-w-6xl mx-auto">
                                <div class="mx-0 sm:mx-6">
                                    <div class=" bg-white w-full text-xl md:text-2xl text-gray-800 leading-normal rounded-t my-4">

                                        <x-blog.post :blogs="$category->blogs"></x-blog.post>

                                    </div>
                            </div>
                        </div>

                   @endforeach
               @endif
    </span>

    </span>
</x-blog.layout>
