<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Skrining APPS</title>

        <!-- Scripts -->
        @vite(['resources/assets/css/main.css',
            'resources/assets/js/vendors/jquery-3.6.0.min.js',
            'resources/assets/js/vendors/bootstrap.bundle.min.js',
            'resources/assets/js/main.js',
        ])
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <header class="main-header style-2 navbar">
            <div class="col-brand">
                <a href="index.html" class="brand-wrap">
                    <img src="{{ asset('images/logo.png') }}" class="logo" alt="Nest Dashboard" />
                </a>
            </div>
            <div class="col-nav">
                <ul class="nav">

                    <li class="nav-item">
                        <a class="nav-link btn-icon darkmode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
                    </li>
                    @if (Route::has('login'))
                        <li class="-mx-3 flex flex-1 justify-end">
                            @auth
                                <a
                                    href="{{ url('/dashboard') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Dashboard
                                </a>
                            @else
                                <a
                                    href="{{ route('login') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </li>
                    @endif
                </ul>
            </div>
        </header>
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-6 position-absolute top-50 start-50 translate-middle">
                    <div class="card">
                        <img src="{{ asset('images/logo.png') }}" class="img-fluid w-25 mx-auto" alt="Nest Dashboard" />
                        <div class="card-body text-center">
                            <h4 class="badge rounded-pill alert-success">WELCOME</h4>
                            <h1>WEBSITE SKRINING PASIEN</h1>
                            <hr>
                            <p>RSD Balung Kabupaten Jember</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
