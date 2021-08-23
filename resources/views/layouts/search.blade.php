<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RealtyHive') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300, 400,700, 800|Raleway:300, 400,700, 800">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/realtyhive.css') }}">
        <!-- required for Algolia elements to show well -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@7.3.1/themes/reset-min.css" integrity="sha256-t2ATOGCtAIZNnzER679jwcFcKYfLlw01gli6F6oszk8=" crossorigin="anonymous">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://kit.fontawesome.com/fd5ef2c1fb.js" crossorigin="anonymous"></script>

    </head>

    <body>
        <div class="relative bg-rh-image bg-center bg-contain">
            @include('layouts.navigation', ['class' => 'bg-blue-500 bg-opacity-75'])

            @include('layouts.alerts')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

        <div>
    </body>
</html>
