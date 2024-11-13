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
        <!-- Agregar Bootstrap CSS -->
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @auth
            @include('layouts.navbar')
            @endauth
            @guest
            @include('layouts.navigation')
            @endguest

            <!-- Page Heading -->
            @if (isset($header))
                @guest
                    
                <header class="dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                @endguest
                @auth 
                    <div class="header">
                        <h1>SMART POINT</h1>
                        <small>Innovación a Tu Alcance</small>
                        <a href="#" class="exit-btn">
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <input class="bi bi-box-arrow-right exit-btn btn btn-danger" type="submit" value="Salir">
                        </form>
                    </div>
                @endauth
                    <!-- Encabezado -->
            @endif

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
