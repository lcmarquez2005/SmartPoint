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
        @vite(['resources/css/app.css', 'resources/css/styles.css', 'resources/css/navbar.css', 'resources/js/app.js'])
    <!-- Incluir jQuery desde CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Incluir Select2 CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Incluir Select2 JS desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>      
                

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @auth
            @include('layouts.navbar')
            @endauth
            @guest
            @endguest

            <!-- Page Heading -->

            @guest 

            @endguest


            @auth 
                <div class="header">
                    <h1>SMART POINT</h1>
                    <small>Innovación a Tu Alcance</small>
                    <form class="exit-btn" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="btn">
                            <div class="lead text-danger bi bi-box-arrow-right"></div>
                            <input class="link-warning btn text-danger" type="submit" value="Salir">
                        </div>
                    </form>
                </div>
            @endauth

            @guest 
                <div class="header m-0 mb-4">
                    <h1>SMART POINT</h1>
                    <small>Innovación a Tu Alcance</small>
                </div>
            @endguest
                    <!-- Encabezado -->


            <!-- Page Content -->
            <main>
            @auth
                <div class="main-content">
            @endauth
                @yield('content')  
            @auth
                </div>
            @endauth
            </main>
        </div>
        
        @stack('scripts') <!-- Permite incluir scripts específicos -->
    </body>
</html>
