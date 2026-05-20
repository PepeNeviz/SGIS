<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('sgis-dark') === 'true' }" x-init="if(localStorage.getItem('sgis-dark') === 'true') document.documentElement.classList.add('dark')" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SGIS') }} — @yield('title', 'Dashboard')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:300,400,500,600,700,800&family=syne:400,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <script>
        // Script ini diletakkan di atas agar dieksekusi sebelum render body
        if (localStorage.getItem('sgis-dark') === 'true' || 
            (!('sgis-dark' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        :root {
            --accent: #6366f1;
            --accent-light: #818cf8;
            --accent-dark: #4f46e5;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-display { font-family: 'Syne', sans-serif; }
        .dark body { color-scheme: dark; }

        /* Smooth dark mode */
        *, *::before, *::after { transition: background-color 0.2s ease, border-color 0.2s ease; }
        a, button { transition: all 0.15s ease !important; }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 min-h-screen">

    @include('layouts.navigation', ['darkModeVar' => 'darkMode'])

    @isset($header)
        <header class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800">
            <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <main>
        @if(isset($slot))
            {{ $slot }}
        @else
            @yield('content')
        @endif
    </main>

    @stack('scripts')
</body>
</html>