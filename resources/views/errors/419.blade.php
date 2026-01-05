<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Session Expired - {{ config('app.name', 'Inventoria') }}</title>

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

    <style>
        .error-bg {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
    </style>
</head>
<body class="error-bg min-h-screen flex items-center justify-center px-4">
    <div class="max-w-md w-full bg-white rounded-lg shadow-xl p-8 text-center">
        <!-- 419 Illustration -->
        <div class="mb-8">
            <svg class="w-32 h-32 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
            </svg>
        </div>

        <!-- Error Code -->
        <h1 class="text-6xl font-bold text-gray-800 mb-4">419</h1>

        <!-- Error Message -->
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Session Expired</h2>

        <p class="text-gray-600 mb-8">
            Your session has expired due to inactivity. Please refresh the page and try again.
        </p>

        <!-- Action Buttons -->
        <div class="space-y-4">
            <button onclick="window.location.reload()" class="inline-block w-full bg-primary text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-600 transition-colors">
                Refresh Page
            </button>

            <a href="{{ url('/') }}" class="inline-block w-full bg-gray-200 text-gray-800 font-semibold py-3 px-6 rounded-lg hover:bg-gray-300 transition-colors">
                Go Home
            </a>

            @auth
                <a href="{{ route('dashboard') }}" class="inline-block w-full bg-green-500 text-white font-semibold py-3 px-6 rounded-lg hover:bg-green-600 transition-colors">
                    Continue to Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="inline-block w-full bg-green-500 text-white font-semibold py-3 px-6 rounded-lg hover:bg-green-600 transition-colors">
                    Sign In Again
                </a>
            @endauth
        </div>

        <!-- Technical Details -->
        <div class="mt-8 p-4 bg-gray-50 rounded-lg">
            <h3 class="text-sm font-semibold text-gray-700 mb-2">Technical Information</h3>
            <p class="text-xs text-gray-600">
                This error occurs when your CSRF token doesn't match or your session has expired.
                Refreshing the page will generate a new token.
            </p>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-sm text-gray-500">
            <p>If this problem persists, please clear your browser cache and cookies.</p>
        </div>
    </div>
</body>
</html>