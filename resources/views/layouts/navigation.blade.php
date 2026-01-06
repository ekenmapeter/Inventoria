<nav 
    x-data="{ 
        open: false, 
        scrolled: false,
        lastScroll: 0,
        showNav: true
    }"
    @scroll.window="
        scrolled = window.scrollY > 10;
        if (window.scrollY < lastScroll) {
            showNav = true;
        } else if (window.scrollY > 100) {
            showNav = false;
        }
        lastScroll = window.scrollY;
    "
    :class="{
        'shadow-lg bg-white/95 dark:bg-gray-900/95 backdrop-blur-md': scrolled,
        'bg-white dark:bg-gray-900': !scrolled,
        '-translate-y-full': !showNav && scrolled
    }"
    class="sticky top-0 z-50 border-b border-gray-200 dark:border-gray-800 transition-all duration-300"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo & Navigation -->
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <x-application-logo class="block h-8 w-auto fill-current text-primary-600 dark:text-primary-400 transition-transform group-hover:scale-110" />
                    <span class="hidden sm:block text-xl font-bold text-gradient">Forum</span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('home') ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                        Forums
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" 
                           class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('payments.index') }}" 
                           class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('payments.*') ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                            Payments
                        </a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" 
                               class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.*') ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                                Admin
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Search & Actions -->
            <div class="flex items-center gap-3">
                <!-- Search Bar (Desktop) -->
                <div class="hidden lg:block relative">
                    <input 
                        type="text" 
                        placeholder="Search forums..." 
                        class="w-64 pl-10 pr-4 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                    >
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>

                <!-- Theme Toggle -->
                <x-theme-toggle />

                @auth
                    <!-- User Dropdown -->
                    <x-user-dropdown :user="auth()->user()" />
                @else
                    <!-- Guest Actions -->
                    <div class="hidden sm:flex items-center gap-2">
                        <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Sign Up</a>
            </div>
                @endauth

                <!-- Mobile Menu Button -->
                <button 
                    @click="open = !open"
                    class="md:hidden p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-primary-500"
                    aria-label="Toggle menu"
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
        class="md:hidden border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900"
        style="display: none;"
    >
        <div class="px-4 py-3 space-y-1">
            <!-- Mobile Search -->
            <div class="relative mb-4">
                <input 
                    type="text" 
                    placeholder="Search forums..." 
                    class="w-full pl-10 pr-4 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500"
                >
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>

            <a href="{{ route('home') }}" 
               class="block px-4 py-2 rounded-lg text-base font-medium {{ request()->routeIs('home') ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                Forums
            </a>
            @auth
                <a href="{{ route('dashboard') }}" 
                   class="block px-4 py-2 rounded-lg text-base font-medium {{ request()->routeIs('dashboard') ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    Dashboard
                </a>
                <a href="{{ route('payments.index') }}" 
                   class="block px-4 py-2 rounded-lg text-base font-medium {{ request()->routeIs('payments.*') ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    Payments
                </a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" 
                       class="block px-4 py-2 rounded-lg text-base font-medium {{ request()->routeIs('admin.*') ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                        Admin Panel
                    </a>
                @endif
                <div class="pt-4 border-t border-gray-200 dark:border-gray-800">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 rounded-lg text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                        Profile
                    </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 rounded-lg text-base font-medium text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                            Logout
                        </button>
                </form>
            </div>
            @else
                <div class="pt-4 border-t border-gray-200 dark:border-gray-800 space-y-2">
                    <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 rounded-lg text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="block w-full text-center px-4 py-2 rounded-lg text-base font-medium bg-primary-600 text-white hover:bg-primary-700">
                        Sign Up
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
