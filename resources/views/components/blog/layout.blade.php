<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ 'RealtyHive Blog' }}</title>

    <!-- Fonts -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Montserrat:300, 400,700, 800|Raleway:300, 400,700, 800">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/realtyhive.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/fd5ef2c1fb.js" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>

</head>
<body class="bg-white font-sans leading-normal tracking-normal">
    <div class="relative bg-rh-image bg-center bg-contain">
        <div class="absolute right-1/4 top-0 bg-white bg-opacity-25 text-white flex space-x-2 p-2">
            <a href="tel:>888-745-7148" class="flex"> <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>888-745-7148</a>
            <a href="mailto:auctions@realtyhive.com" class="flex"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>auctions@realtyhive.com</a>
        </div>
        @include('layouts.navigation', ['class' => 'bg-blue-500 bg-opacity-75'])
        <x-blog.header headerClass="{{ $headerClass??'' }}"></x-blog.header>
    </div>
    <main>
        {{ $slot }}
    </main>
    <footer class="bg-white">
        <div class="container max-w-6xl mx-auto flex items-center px-2 py-8">
            <div class="w-full mx-auto flex flex-wrap items-center">
                <div class="flex w-full md:w-1/2 justify-center md:justify-start text-white font-extrabold">

                </div>
                <div class="flex w-full pt-2 content-center justify-between md:w-1/2 md:justify-end">
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
