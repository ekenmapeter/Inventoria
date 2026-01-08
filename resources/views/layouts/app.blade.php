<!DOCTYPE html>
<<<<<<< HEAD
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
=======
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

<<<<<<< HEAD
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
=======
        <title>{{ isset($title) ? $title . ' - ' : '' }}{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<<<<<<< HEAD
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
=======
    <body class="font-sans antialiased bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-200">
        <div class="min-h-screen flex flex-col">
>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
<<<<<<< HEAD
                <header class="bg-white dark:bg-gray-800 shadow">
=======
                <header class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 shadow-sm">
>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
<<<<<<< HEAD
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
=======
            <main class="flex-1">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <x-flash-messages />
                {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <div class="text-center text-sm text-gray-500 dark:text-gray-400">
                        <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>

>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f
