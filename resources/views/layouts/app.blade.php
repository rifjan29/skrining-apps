<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        @vite(['resources/assets/css/main.css',
            // 'resources/assets/js/vendors/jquery-3.6.0.min.js',
            // 'resources/assets/js/vendors/bootstrap.bundle.min.js',
            'resources/assets/js/vendors/select2.min.js',
            'resources/assets/js/vendors/perfect-scrollbar.js',
            'resources/assets/js/vendors/jquery.fullscreen.js',
            // 'resources/assets/js/vendors/chart.js',
            'resources/assets/js/main.js',
            // 'resources/assets/js/custom-chart.js',
        ])
        @stack('css')
        @stack('js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </head>
    <body class="font-sans antialiased">
        <div class="screen-overlay"></div>
        <div class="min-h-screen bg-gray-100">
            @include('layouts.sidebar')
            <main class="main-wrap">
                @include('layouts.navigation')
                {{ $slot }}
                @include('components.modal-custom')
                @include('layouts.footer')
            </main>
        </div>
    </body>
</html>
