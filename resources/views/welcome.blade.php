<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Inventoria') }}</title>

        <!-- Tailwind CSS via CDN -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Custom Tailwind Configuration -->
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: '#1D4ED8', // blue-700
                        }
                    }
                }
            }
        </script>

        <!-- Custom Styles -->
        <style type="text/tailwindcss">
            @layer components {
                .nav-link {
                    @apply px-4 py-2 text-sm text-gray-700 hover:text-gray-900;
                }
                .btn-primary {
                    @apply px-8 py-3 text-sm font-semibold text-white bg-primary rounded-lg hover:bg-blue-600 transition-colors;
                }
                .feature-card {
                    @apply p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow;
                }
            }
            </style>
    </head>
    <body class="antialiased bg-gray-50">
        <!-- Navigation -->
        <nav class="fixed w-full bg-white/80 backdrop-blur-sm border-b border-gray-100 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <span class="text-xl font-semibold text-gray-800">Inventoria</span>
                    </div>
            @if (Route::has('login'))
                        <div class="flex items-center space-x-4">
                    @auth
                                <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                    @else
                                <a href="{{ route('login') }}" class="nav-link">Sign in</a>
                        @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-primary">Get Started</a>
                        @endif
                    @endauth
                        </div>
                    @endif
                </div>
            </div>
                </nav>

        <!-- Hero Section -->
        <div class="relative min-h-screen">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <!-- Left side - Hero Content -->
                    <div class="text-center md:text-left">
                        <h1 class="text-5xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                            Inventory Management
                            <span class="block text-primary">Made Simple</span>
                        </h1>

                        <p class="mt-6 text-lg leading-8 text-gray-600 max-w-2xl">
                            Track inventory, manage multiple locations, and streamline your operations with our powerful system.
                        </p>
                    </div>

                    <!-- Right side - Login Form -->
                    <div class="bg-white p-8 rounded-lg shadow-lg">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Sign In</h2>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" id="email" required
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                                           value="{{ old('email') }}">
                                </div>

                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                    <input type="password" name="password" id="password" required
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input type="checkbox" name="remember" id="remember"
                                               class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">
                                        <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-sm text-primary hover:text-blue-600">
                                            Forgot password?
                                        </a>
            @endif
                                </div>

                                <button type="submit" class="w-full btn-primary">
                                    Sign in
                                </button>
                            </div>
                        </form>

                        <p class="mt-4 text-center text-sm text-gray-600">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="text-primary hover:text-blue-600 font-medium">
                                Create one now
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Feature Cards -->
                <div class="mt-32 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Card 1 -->
                    <div class="feature-card">
                        <div class="flex items-start space-x-4">
                            <svg class="w-8 h-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                            <div>
                                <h3 class="font-semibold text-gray-900">Multi-Location</h3>
                                <p class="mt-1 text-sm text-gray-600">Manage inventory across multiple warehouses and stores</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="feature-card">
                        <div class="flex items-start space-x-4">
                            <svg class="w-8 h-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                            <div>
                                <h3 class="font-semibold text-gray-900">Real-time Tracking</h3>
                                <p class="mt-1 text-sm text-gray-600">Monitor stock levels and movements in real-time</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="feature-card">
                        <div class="flex items-start space-x-4">
                            <svg class="w-8 h-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                            <div>
                                <h3 class="font-semibold text-gray-900">Analytics</h3>
                                <p class="mt-1 text-sm text-gray-600">Powerful insights and reporting tools</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
