<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('sgis-dark') === 'true' }" x-init="if(localStorage.getItem('sgis-dark') === 'true') document.documentElement.classList.add('dark')" :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SGIS') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:300,400,500,600,700,800&family=syne:400,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --accent: #6366f1;
                --accent-light: #818cf8;
                --accent-dark: #4f46e5;
            }
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .font-display { font-family: 'Syne', sans-serif; }
            .dark body { color-scheme: dark; }
            *, *::before, *::after { transition: background-color 0.2s ease, border-color 0.2s ease; }
            a, button { transition: all 0.15s ease !important; }
        </style>
    </head>

    <body class="font-sans antialiased bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 min-h-screen">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500 dark:text-gray-400" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-900">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
