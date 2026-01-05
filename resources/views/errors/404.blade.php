<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page Not Found - {{ config('app.name', 'Inventoria') }}</title>

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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="error-bg min-h-screen flex items-center justify-center px-4">
    <div class="max-w-md w-full bg-white rounded-lg shadow-xl p-8 text-center">
        <!-- 404 Illustration -->
        <div class="mb-8">
            <svg class="w-32 h-32 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.29-.98-5.5-2.5m.5-4C6.5 9 7.5 9 9 9s2.5 0 3.5-1m-3.5-4C8.5 4 9.5 4 12 4s3.5 0 3.5 1m-7 8c0 1.38.56 2.63 1.5 3.5M12 21c4.418 0 8-4.03 8-9s-3.582-9-8-9-8 4.03-8 9a9.863 9.863 0 001.5 5.25" />
            </svg>
        </div>

        <!-- Error Code -->
        <h1 class="text-6xl font-bold text-gray-800 mb-4">404</h1>

        <!-- Error Message -->
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Page Not Found</h2>

        <p class="text-gray-600 mb-8">
            Sorry, the page you are looking for doesn't exist or has been moved.
        </p>

        <!-- Action Buttons -->
        <div class="space-y-4">
            <a href="{{ url('/') }}" class="inline-block w-full bg-primary text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-600 transition-colors">
                Go Home
            </a>

            @auth
                <a href="{{ route('dashboard') }}" class="inline-block w-full bg-gray-200 text-gray-800 font-semibold py-3 px-6 rounded-lg hover:bg-gray-300 transition-colors">
                    Go to Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="inline-block w-full bg-gray-200 text-gray-800 font-semibold py-3 px-6 rounded-lg hover:bg-gray-300 transition-colors">
                    Sign In
                </a>
            @endauth

            <button onclick="history.back()" class="inline-block w-full bg-gray-100 text-gray-700 font-semibold py-3 px-6 rounded-lg hover:bg-gray-200 transition-colors">
                Go Back
            </button>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-sm text-gray-500">
            <p>If you believe this is an error, please contact support.</p>
        </div>
    </div>
</body>
</html>