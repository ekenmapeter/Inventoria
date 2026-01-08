@props(['title' => 'Admin'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }} - Admin - {{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-200">
        <div class="min-h-screen flex flex-col">
            <!-- Admin Navigation -->
            <nav 
                x-data="{ open: false, scrolled: false }"
                @scroll.window="scrolled = window.scrollY > 10"
                :class="{
                    'shadow-lg bg-gray-900/95 dark:bg-gray-950/95 backdrop-blur-md': scrolled,
                    'bg-gray-900 dark:bg-gray-950': !scrolled
                }"
                class="sticky top-0 z-50 border-b border-gray-800 transition-all duration-300"
            >
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <div class="flex items-center gap-8">
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 group">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary-400 to-accent-500 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <span class="text-xl font-bold text-white">Admin Panel</span>
                            </a>

                            <!-- Desktop Navigation -->
                            <div class="hidden md:flex items-center gap-1">
                                <a href="{{ route('admin.dashboard') }}" 
                                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                                    Dashboard
                                </a>
                                <a href="{{ route('admin.forums.index') }}" 
                                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.forums.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                                    Forums
                                </a>
                                <a href="{{ route('admin.users.index') }}" 
                                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                                    Members
                                </a>
                                <div x-data="{ open: false }" class="relative">
                                    <button 
                                        @click="open = !open"
                                        class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.payments.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} flex items-center gap-1">
                                        Payments
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>
                                    <div 
                                        x-show="open"
                                        @click.away="open = false"
                                        x-transition
                                        class="absolute top-full left-0 mt-2 w-48 bg-gray-800 rounded-lg shadow-lg py-1 z-50"
                                        style="display: none;"
                                    >
                                        <a href="{{ route('admin.payments.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5 hover:text-white">
                                            All Payments
                                        </a>
                                        <a href="{{ route('admin.payments.monthly-dues') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5 hover:text-white">
                                            Monthly Dues
                                        </a>
                                        <a href="{{ route('admin.payments.subscriptions') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5 hover:text-white">
                                            Subscriptions
                                        </a>
                                    </div>
                                </div>
                                <a href="{{ route('admin.deposits.index') }}" 
                                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.deposits.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                                    Deposits
                                </a>
                                <a href="{{ route('admin.settings.index') }}" 
                                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.settings.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                                    Settings
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <x-theme-toggle />
                            <a href="{{ route('home') }}" class="hidden sm:flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                View Site
                            </a>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white transition-colors">
                                    Logout
                                </button>
                            </form>

                            <!-- Mobile Menu Button -->
                            <button 
                                @click="open = !open"
                                class="md:hidden p-2 rounded-lg text-gray-300 hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-primary-500"
                            >
                                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div 
                    x-show="open"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-2"
                    class="md:hidden border-t border-gray-800 bg-gray-900"
                    style="display: none;"
                >
                    <div class="px-4 py-3 space-y-1">
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-lg text-base font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.forums.index') }}" class="block px-4 py-2 rounded-lg text-base font-medium {{ request()->routeIs('admin.forums.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5' }}">
                            Forums
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 rounded-lg text-base font-medium {{ request()->routeIs('admin.users.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5' }}">
                            Members
                        </a>
                        <a href="{{ route('admin.payments.index') }}" class="block px-4 py-2 rounded-lg text-base font-medium {{ request()->routeIs('admin.payments.index') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5' }}">
                            All Payments
                        </a>
                        <a href="{{ route('admin.payments.monthly-dues') }}" class="block px-4 py-2 rounded-lg text-base font-medium {{ request()->routeIs('admin.payments.monthly-dues') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5' }}">
                            Monthly Dues
                        </a>
                        <a href="{{ route('admin.payments.subscriptions') }}" class="block px-4 py-2 rounded-lg text-base font-medium {{ request()->routeIs('admin.payments.subscriptions') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5' }}">
                            Subscriptions
                        </a>
                        <a href="{{ route('admin.deposits.index') }}" class="block px-4 py-2 rounded-lg text-base font-medium {{ request()->routeIs('admin.deposits.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5' }}">
                            Deposits
                        </a>
                        <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 rounded-lg text-base font-medium {{ request()->routeIs('admin.settings.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5' }}">
                            Settings
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="flex-1">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <x-flash-messages />
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
