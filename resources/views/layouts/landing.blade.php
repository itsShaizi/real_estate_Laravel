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

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://kit.fontawesome.com/fd5ef2c1fb.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="relative">
            @include('layouts.navigation')

            @include('layouts.alerts')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <div class="relative">
            @include('layouts.footer')
        <div>
    </body>

</html>

<script>

</script>