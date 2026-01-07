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
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-blue-50 to-indigo-100">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="bg-white p-4 rounded-full shadow-lg mb-8">
                <a href="/">
                    <img src="{{ asset('images/welcome.png') }}" alt="Site Logo" class="w-16 h-16 object-contain" />
                </a>
            </div>

            <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-xl overflow-hidden sm:rounded-xl border border-gray-200">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
