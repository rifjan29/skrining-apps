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
        @vite(['resources/assets/css/main.css',
            'resources/assets/js/vendors/jquery-3.6.0.min.js',
            'resources/assets/js/vendors/bootstrap.bundle.min.js',
            'resources/assets/js/main.js',
        ])
        <style>
            .bg-gambar{
                position: relative;
            }

            .bg-gambar .overlay::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(27, 138, 138, 0.68); /* Adjust the opacity as needed */
                z-index: 1;
                width: 100%;
            }
            .text{
                z-index: 99999;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <main>
            <header class="main-header style-2 navbar">
                <div class="col-brand">
                    <a href="{{ route('dashboard') }}" class="brand-wrap">
                        <img src="{{ asset('images/logo.png') }}" class="logo" alt="Nest Dashboard" />
                    </a>
                </div>
                <div class="col-nav">
                    <ul class="nav">

                        <li class="nav-item">
                            <a class="nav-link btn-icon darkmode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
                        </li>
                    </ul>
                </div>
            </header>
            <section class="content-main mt-80 mb-80">
                {{ $slot }}
            </section>
            <footer class="main-footer text-center">
                <p class="font-xs">
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    &copy; Nest - HTML Ecommerce Template .
                </p>
                <p class="font-xs mb-30">All rights reserved</p>
            </footer>
        </main>
    </body>
</html>
