<x-blog.layout>
    <!--Container-->
    <div class="container mx-auto py-6 border-b" style="max-width: 1310px;">
        <div class="flex justify-between">
            <h2 class="text-gray-400">Blog - Latest News</h2>
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
                                <div class="border-b border-gray-200">
                                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                        <a href="#" class="border-indigo-500 text-indigo-600 group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm" aria-current="page">
                                            <svg class="text-indigo-500 -ml-0.5 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"
                                                /></svg><span>Author</span>
                                        </a>
                                        <a href="./post-recent-post.html" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm">
                                            <!-- Heroicon name: solid/credit-card -->
                                            <svg class="text-gray-400 group-hover:text-gray-500 -ml-0.5 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>Recent Posts</span>
                                        </a>
                                    </nav>
                                </div>
                                <!-- tab content start -->
                                <div class="my-3 divide-y divide-gray-200 divide-solid">
                                    <div class="md:flex md:items-center md:justify-between md:space-x-5 py-6">
                                        <div class="flex items-start space-x-5">
                                            <div class="flex-shrink-0">
                                                <div class="relative">
                                                    <img class="h-16 w-16 rounded-full" src="https://iamvaccinated.sg/wp-content/uploads/2021/03/avartar15.png" alt="" />
                                                    <span
                                                        class="absolute inset-0 shadow-inner rounded-full"
                                                        aria-hidden="true"
                                                    ></span>
                                                </div>
                                            </div>
                                            <!--
                                                Use vertical padding to simulate center alignment when both lines of text are one line,
                                                but preserve the same layout if the text wraps without making the image jump around.
                                              -->
                                            <div class="pt-1.5">
                                                <h1 class="text-2xl font-bold text-gray-900">
                                                    {{ $blog->author->first_name }}&nbsp;{{ $blog->author->last_name }}
                                                </h1>
                                                <p class="text-sm font-medium text-gray-500">
                                                    Digital Marketing Consultant @
                                                    <a href="#" class="text-indigo-500 hover:text-indigo-600">RealtyHive
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse
                          sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3">
                                            <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
                                                View Profile
                                            </button>
                                        </div>
                                    </div>
                                    <div class="md:space-x-5">
                                        <section aria-labelledby="notes-title">
                                            <div class="bg-white shadow sm:rounded-lg sm:overflow-hidden">
                                                <div class="">
                                                    <div class="px-4 py-5 sm:px-6">
                                                        <h2 id="notes-title" class="text-lg font-medium text-gray-900">
                                                            Comments
                                                        </h2>
                                                    </div>
                                                    <div class="px-4 py-6 sm:px-6">
                                                        <ul role="list" class="space-y-8">
                                                            @foreach($blog->comments as $comment)
                                                            <li>
                                                                <div class="flex space-x-3">
                                                                    <div class="flex-shrink-0">
                                                                        <img
                                                                            class="h-10 w-10 rounded-full"
                                                                            src="https://e7.pngegg.com/pngimages/182/371/png-clipart-user-profile-login-computer-icons-avatar-avatar-child-face-thumbnail.png" alt=""/>
                                                                    </div>
                                                                    <div>
                                                                        <div class="text-sm">
                                                                            <a href="#" class="font-medium text-gray-900">{{ $comment->name }}</a>
                                                                        </div>
                                                                        <div class="mt-1 text-sm text-gray-700">
                                                                            <p class="w-full">
                                                                                {{ $comment->comment }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="mt-2 text-sm space-x-2">
                                        <span class="text-gray-500 font-medium"
                                        >{{ $comment->created_at }}</span>
                                                                            <span class="text-gray-500 font-medium"
                                                                            >&middot;</span>
                                                                            <button type="button" class="text-gray-900 font-medium"> Reply </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="bg-gray-50 px-4 py-6 sm:px-6">
                                                    <div class="text-center">Want to join the discussion? <br>Feel free to contribute!</div>
                                                    <div class="flex space-x-3">
                                                        <div class="flex-shrink-0">
                                                            <img class="h-10 w-10 rounded-full" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGjqeuUmIgRcJJSKf9Oyvw-i6VRj3Nq5LZpvyhH7czkcNJ7YwJRflvel5onEPrwa-h49E&usqp=CAU" alt="" />
                                                        </div>
                                                        <div class="min-w-0 flex-1">
                                                            <form action="{{ url('comment/store') }}" method="POST">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                                                <div class="pt-2">
                                                                    <label for="comment" class="sr-only">About</label>
                                                                    <textarea required id="comment" name="comment" rows="3" class="shadow-sm block w-full focus:ring-blue-500 focus:border-blue-500 sm:text-sm border border-gray-300 rounded-md" placeholder="Add a comment"></textarea>
                                                                </div>
                                                                <div class="pt-2">
                                                                    <label for="name" class="sr-only">Name</label>
                                                                    <input required id="name" type="text" name="name" class="shadow-sm block w-full focus:ring-blue-500 focus:border-blue-500 border border-gray-300 rounded-md" placeholder="Name">
                                                                </div>
                                                                <div class="pt-2">
                                                                    <label for="email" class="sr-only">Email</label>
                                                                    <input required id="email" type="email" name="email" class="shadow-sm block w-full focus:ring-blue-500 focus:border-blue-500 border border-gray-300 rounded-md" placeholder="Email">
                                                                </div>
                                                                <div class="pt-2">
                                                                    <label for="website" class="sr-only">Website</label>
                                                                    <input id="website" type="texy" name="website" class="shadow-sm block w-full focus:ring-blue-500 focus:border-blue-500 border border-gray-300 rounded-md" placeholder="Website">
                                                                </div>
                                                                <div class="mt-3 flex items-center justify-between">

                                                                    <button type="submit" class=" inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"> Comment
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Subscribe-->

                        <!-- /Subscribe-->
                    </div>
                </div>
            </div>
            <!-- End main area -->
        </main>
        <aside class="hidden relative xl:flex xl:flex-col flex-shrink-0 w-96 border-l border-gray-200">
            <!-- Start secondary column (hidden on smaller screens) -->
            <div class="inset-0 py-6 px-4 sm:px-6 lg:px-8">
                <div class="h-full rounded-lg space-y-16">
                    <!-- search start -->

                    <div class="relative">
                        <input type="text" class="border border-gray-200 h-14 w-80 pl-10 pr-20 z-0 focus:shadow focus:outline-none" placeholder="Search anything..." />
                        <div class="absolute top-0 right-0">
                            <button class="h-14 w-14 text-white bg-indigo-500 hover:bg-indigo-600">
                                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <!-- search end -->
                    <!-- news letter -->
                    <h2 class="text-xl text-left inline-block font-bold text-gray-800">
                        BUZZ SIGNUP
                    </h2>
                    <div class="px-4 pt-3 pb-4 mx-4">
                        <div class="max-w-xl mx-auto">
                            <div class="text-center space-y-7 mx-4">
                                <h2 class="text-4xl text-center inline-block font-extrabold text-gray-800">
                                    Join The Buzz
                                </h2>
                                <p class="text-gray-700 text-lg">
                                    Get the best content delivered straight to your inbox once
                                    per month.
                                </p>
                            </div>

                            <form action="#" class="mt-4">
                                <div class="relative">
                                    <input type="text" class="border border-gray-200 h-14 w-full pl-10 z-0 focus:shadow focus:outline-none" placeholder="Search anything..." />
                                    <div class="absolute top-0 right-0">
                                        <button class="capitalize h-14 w-14 text-white bg-indigo-500 hover:bg-indigo-600 "> Join
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end newslater -->

                    <!-- categories -->
                    <div class="space-y-1">
                        <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider" id="projects-headline"> Categories
                        </h3>
                        <div class="space-y-1" role="group" aria-labelledby="projects-headline" >
                            <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50">
                                <span class="truncate"> Website redesign </span>
                            </a>

                            <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50">
                                <span class="truncate"> GraphQL API </span>
                            </a>

                            <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50">
                                <span class="truncate"> Customer migration guides </span>
                            </a>

                            <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50">
                                <span class="truncate"> Profit sharing program </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End secondary column -->
        </aside>
    </div>
</x-blog.layout>
