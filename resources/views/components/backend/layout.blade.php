<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RealtyHive Fitting-Room') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300, 400,700, 800|Raleway:300, 400,700, 800">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/realtyhive.css') }}">
        
        @livewireStyles
        @stack('styles')

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://kit.fontawesome.com/fd5ef2c1fb.js" crossorigin="anonymous"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
        <script type="text/javascript" src="/js/common.js"></script>
        
    </head>

    <body>
        <div class="relative">

            <main class="flex-col md:flex md:flex-row overflow-x-hidden">
                    @include('backend.navigation')
                    
                    <div class="p-4 no-shadow md:shadow-2xl w-full">
                        @if ($message = Session::get('success'))
                            <x-message :message="$message" color="green" />
                        @elseif ($message = Session::get('error'))
                            <x-message :message="$message" color="red" error="true"/>
                        @endif
                    <!-- Page Content -->
                    {{ $slot }}
                    </div>
            </main>

        <div>
        
        @livewireScripts
        @stack('scripts')

    </body>
</html>
