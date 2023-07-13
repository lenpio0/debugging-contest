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
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased" x-data="{ openModale: false }">
        <x-banner />

        <div class="min-h-screen bg-cover bg-center" style="background-image: url('https://source.unsplash.com/random/1920x1080')">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="backdrop-blur-md bg-white/60 shadow sticky top-0">
                    <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 ">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
