<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ 'RealtyHive Blog' }}</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="author" content="name"/>
    <meta name="description" content="description here"/>
    <meta name="keywords" content="keywords,here"/>
    <link
        href="https://unpkg.com/tailwindcss/dist/tailwind.min.css"
        rel="stylesheet"
    />
    <!--Replace with your tailwind.css once created-->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css"
        rel="stylesheet"
    />
</head>
<body class="bg-gray-200 font-sans leading-normal tracking-normal">
<!--Header-->
<div
    class="w-full m-0 p-0 bg-cover"
    style="
        background-image: linear-gradient(
            rgba(70, 98, 255, 63%),
            rgba(80, 119, 156, 0.9)
          ),
          url(./images/blog-homepage/Artboard-5.png);
        height: 60vh;
        max-height: 460px;
      "
>
    <div
        class="
          container
          max-w-4xl
          mx-auto
          pt-16
          md:pt-32
          text-center
          break-normal
        "
    >
        <!--Title-->
        <p class="text-white font-extrabold text-3xl md:text-5xl">The Buzz</p>
        <p class="text-xl md:text-2xl text-gray-300">Welcome to my Blog</p>
    </div>
</div>

<!--Container-->
<div class="container px-4 md:px-0 max-w-6xl mx-auto -mt-20">
    <div class="mx-0 sm:mx-6">
        <!--Nav-->
        <div
            class="
            bg-gray-200
            w-full
            text-xl
            md:text-2xl
            text-gray-800
            leading-normal
            rounded-t
            my-4
          "
        >
            <!--Feature-blog Card-->
            <x-blog.feature-blog>

            </x-blog.feature-blog>
            <!--/Feature-blog Card-->

            <!--Posts Container-->
            <div class="grid grid-col-1 md:grid-cols-2 lg:grid-cols-3 pt-12 -mx-6">
                <div class="w-full p-6 flex flex-col flex-grow flex-shrink" >
                    <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
                        <a href="#" class="flex flex-wrap no-underline hover:no-underline">
                            <img src="./images/blog-homepage/blog-thumb.jpg" class="h-64 w-full rounded-t pb-6"/>
                            <div class="w-full font-bold text-xl text-gray-900 px-6">
                                How to Sell a House as an Owner in Wisconsin?
                            </div>
                            <p class="text-gray-800 font-serif text-base px-6 mb-5">
                                Selling your home can be surprisingly time-consuming and
                                emotionally…
                            </p>
                        </a>
                    </div>

                    <div
                        class="
                  flex-none
                  mt-auto
                  bg-white
                  rounded-b rounded-t-none
                  overflow-hidden
                  shadow-lg
                  p-6
                "
                    >
                        <div class="flex items-center justify-between">
                            <p class="text-gray-600 text-xs md:text-sm">James</p>
                            <p class="text-gray-600 text-xs md:text-sm">21 Jul 2021</p>
                        </div>
                    </div>
                </div>
                <div class="w-full p-6 flex flex-col flex-grow flex-shrink" >
                    <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
                        <a href="#" class="flex flex-wrap no-underline hover:no-underline">
                            <img src="./images/blog-homepage/blog-thumb.jpg" class="h-64 w-full rounded-t pb-6"/>
                            <div class="w-full font-bold text-xl text-gray-900 px-6">
                                How to Sell a House as an Owner in Wisconsin?
                            </div>
                            <p class="text-gray-800 font-serif text-base px-6 mb-5">
                                Selling your home can be surprisingly time-consuming and
                                emotionally…
                            </p>
                        </a>
                    </div>

                    <div
                        class="
                  flex-none
                  mt-auto
                  bg-white
                  rounded-b rounded-t-none
                  overflow-hidden
                  shadow-lg
                  p-6
                "
                    >
                        <div class="flex items-center justify-between">
                            <p class="text-gray-600 text-xs md:text-sm">James</p>
                            <p class="text-gray-600 text-xs md:text-sm">21 Jul 2021</p>
                        </div>
                    </div>
                </div>
                <div class="w-full p-6 flex flex-col flex-grow flex-shrink" >
                    <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
                        <a href="#" class="flex flex-wrap no-underline hover:no-underline">
                            <img src="./images/blog-homepage/blog-thumb.jpg" class="h-64 w-full rounded-t pb-6"/>
                            <div class="w-full font-bold text-xl text-gray-900 px-6">
                                How to Sell a House as an Owner in Wisconsin?
                            </div>
                            <p class="text-gray-800 font-serif text-base px-6 mb-5">
                                Selling your home can be surprisingly time-consuming and
                                emotionally…
                            </p>
                        </a>
                    </div>

                    <div
                        class="
                  flex-none
                  mt-auto
                  bg-white
                  rounded-b rounded-t-none
                  overflow-hidden
                  shadow-lg
                  p-6
                "
                    >
                        <div class="flex items-center justify-between">
                            <p class="text-gray-600 text-xs md:text-sm">James</p>
                            <p class="text-gray-600 text-xs md:text-sm">21 Jul 2021</p>
                        </div>
                    </div>
                </div>
            </div>

            <!--/ Post Content-->
            <!-- pagination -->

            <div
                class="
              bg-white
              px-4
              py-3
              flex
              items-center
              justify-between
              border-t border-gray-200
              sm:px-6
            "
            >
                <div class="flex-1 flex justify-between sm:hidden">
                    <a
                        href="#"
                        class="
                  relative
                  inline-flex
                  items-center
                  px-4
                  py-2
                  border border-gray-300
                  text-sm
                  font-medium
                  rounded-md
                  text-gray-700
                  bg-white
                  hover:bg-gray-50
                "
                    >
                        Previous
                    </a>
                    <a
                        href="#"
                        class="
                  ml-3
                  relative
                  inline-flex
                  items-center
                  px-4
                  py-2
                  border border-gray-300
                  text-sm
                  font-medium
                  rounded-md
                  text-gray-700
                  bg-white
                  hover:bg-gray-50
                "
                    >
                        Next
                    </a>
                </div>
                <div
                    class="
                hidden
                sm:flex-1 sm:flex sm:items-center sm:justify-between
              "
                >
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing
                            <span class="font-medium">1</span>
                            to
                            <span class="font-medium">10</span>
                            of
                            <span class="font-medium">97</span>
                            results
                        </p>
                    </div>
                    <div>
                        <nav
                            class="
                    relative
                    z-0
                    inline-flex
                    rounded-md
                    shadow-sm
                    -space-x-px
                  "
                            aria-label="Pagination"
                        >
                            <a
                                href="#"
                                class="
                      relative
                      inline-flex
                      items-center
                      px-2
                      py-2
                      rounded-l-md
                      border border-gray-300
                      bg-white
                      text-sm
                      font-medium
                      text-gray-500
                      hover:bg-gray-50
                    "
                            >
                                <span class="sr-only">Previous</span>
                                <!-- Heroicon name: solid/chevron-left -->
                                <svg
                                    class="h-5 w-5"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </a>
                            <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                            <a
                                href="#"
                                aria-current="page"
                                class="
                      z-10
                      bg-indigo-50
                      border-indigo-500
                      text-indigo-600
                      relative
                      inline-flex
                      items-center
                      px-4
                      py-2
                      border
                      text-sm
                      font-medium
                    "
                            >
                                1
                            </a>
                            <a
                                href="#"
                                class="
                      bg-white
                      border-gray-300
                      text-gray-500
                      hover:bg-gray-50
                      relative
                      inline-flex
                      items-center
                      px-4
                      py-2
                      border
                      text-sm
                      font-medium
                    "
                            >
                                2
                            </a>
                            <a
                                href="#"
                                class="
                      bg-white
                      border-gray-300
                      text-gray-500
                      hover:bg-gray-50
                      hidden
                      md:inline-flex
                      relative
                      items-center
                      px-4
                      py-2
                      border
                      text-sm
                      font-medium
                    "
                            >
                                3
                            </a>
                            <span
                                class="
                      relative
                      inline-flex
                      items-center
                      px-4
                      py-2
                      border border-gray-300
                      bg-white
                      text-sm
                      font-medium
                      text-gray-700
                    "
                            >
                    ...
                  </span>
                            <a
                                href="#"
                                class="
                      bg-white
                      border-gray-300
                      text-gray-500
                      hover:bg-gray-50
                      hidden
                      md:inline-flex
                      relative
                      items-center
                      px-4
                      py-2
                      border
                      text-sm
                      font-medium
                    "
                            >
                                8
                            </a>
                            <a
                                href="#"
                                class="
                      bg-white
                      border-gray-300
                      text-gray-500
                      hover:bg-gray-50
                      relative
                      inline-flex
                      items-center
                      px-4
                      py-2
                      border
                      text-sm
                      font-medium
                    "
                            >
                                9
                            </a>
                            <a
                                href="#"
                                class="
                      bg-white
                      border-gray-300
                      text-gray-500
                      hover:bg-gray-50
                      relative
                      inline-flex
                      items-center
                      px-4
                      py-2
                      border
                      text-sm
                      font-medium
                    "
                            >
                                10
                            </a>
                            <a
                                href="#"
                                class="
                      relative
                      inline-flex
                      items-center
                      px-2
                      py-2
                      rounded-r-md
                      border border-gray-300
                      bg-white
                      text-sm
                      font-medium
                      text-gray-500
                      hover:bg-gray-50
                    "
                            >
                                <span class="sr-only">Next</span>
                                <!-- Heroicon name: solid/chevron-right -->
                                <svg
                                    class="h-5 w-5"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="bg-gray-900">
    <div class="container max-w-6xl mx-auto flex items-center px-2 py-8">
        <div class="w-full mx-auto flex flex-wrap items-center">
            <div
                class="
              flex
              w-full
              md:w-1/2
              justify-center
              md:justify-start
              text-white
              font-extrabold
            "
            >
                <a
                    class="
                text-gray-900
                no-underline
                hover:text-gray-900 hover:no-underline
              "
                    href="#"
                >
                    👻 <span class="text-base text-gray-200">The Buzz</span>
                </a>
            </div>
            <div
                class="
              flex
              w-full
              pt-2
              content-center
              justify-between
              md:w-1/2 md:justify-end
            "
            ></div>
        </div>
    </div>
</footer>

<script src="https://unpkg.com/popper.js@1/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@4"></script>
<script>
    //Init tooltips
    tippy(".avatar");
</script>
</body>
</html>
