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
    <style>
        .header-background{
            background-image: linear-gradient(
                rgba(70, 98, 255, 63%),
                rgba(80, 119, 156, 0.9)
            ),
            url(./images/blog-homepage/Artboard-5.png);
            height: 20vh;
            max-height: 460px;
        }

    </style>
</head>
<body class="bg-white font-sans leading-normal tracking-normal">
    @include('layouts.navigation', ['class' => 'bg-blue-500 bg-opacity-75 header-background'])
    {{ $slot }}

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
