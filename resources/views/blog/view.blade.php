<x-blog.layout headerClass="hidden">
    <!--Container-->
    <div class="container mx-auto py-6 border-b" style="max-width: 1310px;">
        <div class="flex justify-between">
            <a  href="{{ route('sd-blogs') }}" class="h2 text-gray-400">Blog - Latest News</a>
            <p class="text-xs text-gray-400">
            You are here Home / {{ $blog->title }}
            </p>
        </div>
    </div>
    <div
        style=""
        class="flex-1 relative z-0 flex overflow-hidden container mx-auto"
    >
    <div style="max-width: 1310px" class="flex-1 relative z-0 flex overflow-hidden container mx-auto">
        <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none">
            <!-- Start main area-->
            <div class="inset-0 py-6 px-4 sm:px-6 lg:px-8">
                <div class="h-full rounded-lg">
                    <div class="text-center">
                        <h1 class="font-bold break-normal text-2xl md:text-4xl">
                            {{ $blog->title }}
                        </h1>
                        <p class="text-sm md:text-base text-gray-400 font-light">
                            {{ $blog->created_at }} <span class="text-gray-900">/</span> 0 Comments
                            <span class="text-gray-900">/</span> by {{ $blog->author->first_name }}&nbsp;{{ $blog->author->last_name }}
                        </p>
                    </div>

                    <!--image-->
                    <div class="container w-full max-w-6xl mx-auto bg-white bg-cover mt-8 rounded" style="max-width: 1310px">
                        <img class="max-w-full max-h-full object-cover" src="{{  !empty($blog->cover_image) ? '/storage/blogs/images/' . $blog->id . '/original/' .$blog->cover_image->title : '/images/resources/no-image-yellow.jpg' }}" alt="Image" />
                    </div>
                    <div class="mx-0 sm:mx-6">
                        <div class="bg-white w-full p-8 text-xl md:text-2xl text-gray-800 leading-normal" style="font-family: Georgia, serif">
                            <!--Post Content-->
                        {!! $blog->content !!}
                            <!--/ Post Content-->
                        </div>
                        <!-- start tabs -->
                        <div>
                            <div class="sm:hidden">
                                <label for="tabs" class="sr-only">Select a tab</label>
                                <select id="tabs" name="tabs" class="block w-full focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                    <option>My Account</option>
                                    <option>Company</option>
                                    <option selected>Team Members</option>
                                    <option>Billing</option>
                                </select>
                            </div>
                            <div class="hidden sm:block">
                                
                                <div class="my-3 divide-y divide-gray-200 divide-solid">
                                    <div class="md:flex md:items-center md:justify-between md:space-x-5 py-6">
                                        <div class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse
                          sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3">
                                            {{-- <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
                                                View Profile
                                            </button> --}}
                                        </div>
                                    </div>
                                    <div class="md:space-x-5">
                                        <x-blog.comment-replies-section :blog="$blog"></x-blog.comment-replies-section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End main area -->
        </main>
        <aside class="hidden relative xl:flex xl:flex-col flex-shrink-0 w-96 border-l border-gray-200">
            <!-- Start secondary column (hidden on smaller screens) -->
            <div class="inset-0 py-6 px-4 sm:px-6 lg:px-8">
                <div class="h-full rounded-lg space-y-16">
                    <x-blog.search></x-blog.search>
                    <x-blog.signup></x-blog.signup>
                    <x-blog.category></x-blog.category>
                </div>
            </div>
            <!-- End secondary column -->
        </aside>
    </div>
</x-blog.layout>
