<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Admin Navigation -->
            <nav class="bg-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('admin.dashboard') }}" class="text-white font-bold text-xl">
                                    Admin Panel
                                </a>
                            </div>
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-white hover:border-gray-300 focus:outline-none focus:text-white focus:border-gray-300 transition">
                                    Dashboard
                                </a>
                                <a href="{{ route('admin.forums.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-white hover:border-gray-300 focus:outline-none focus:text-white focus:border-gray-300 transition">
                                    Forums
                                </a>
                                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-white hover:border-gray-300 focus:outline-none focus:text-white focus:border-gray-300 transition">
                                    Users
                                </a>
                                <a href="{{ route('admin.payments.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-white hover:border-gray-300 focus:outline-none focus:text-white focus:border-gray-300 transition">
                                    Payments
                                </a>
                                <a href="{{ route('admin.packages.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-white hover:border-gray-300 focus:outline-none focus:text-white focus:border-gray-300 transition">
                                    Packages
                                </a>
                            </div>
                        </div>
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <a href="{{ route('home') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                View Site
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="ms-3">
                                @csrf
                                <button type="submit" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        @if(session('success'))
                            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>

