<x-blog.layout>
    <!--Container-->
    <div class="container px-4 md:px-0 max-w-6xl mx-auto">
        <div class="mx-0 sm:mx-6">

            <!--Nav-->

            @if(!empty($category))
                    <x-blog.category-header :category="$category"></x-blog.category-header>
                @endif
            <div class=" bg-white w-full text-xl md:text-2xl text-gray-800 leading-normal rounded-t my-4">

                <x-blog.post :blogs="$blogs"></x-blog.post>

                <!-- pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    {!! $blogs->links() !!}
                </div>
            <!-- /Page Content -->
            </div>
        </div>
    </div>
</x-blog.layout>
