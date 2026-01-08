<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Server Error - {{ config('app.name', 'Inventoria') }}</title>

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
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        }
    </style>
</head>
<body class="error-bg min-h-screen flex items-center justify-center px-4">
    <div class="max-w-md w-full bg-white rounded-lg shadow-xl p-8 text-center">
        <!-- 500 Illustration -->
        <div class="mb-8">
            <svg class="w-32 h-32 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>

        <!-- Error Code -->
        <h1 class="text-6xl font-bold text-gray-800 mb-4">500</h1>

        <!-- Error Message -->
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Server Error</h2>

        <p class="text-gray-600 mb-8">
            Something went wrong on our end. We're working to fix this issue.
        </p>

        <!-- Action Buttons -->
        <div class="space-y-4">
            <button onclick="window.location.reload()" class="inline-block w-full bg-primary text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-600 transition-colors">
                Try Again
            </button>

            <a href="{{ url('/') }}" class="inline-block w-full bg-gray-200 text-gray-800 font-semibold py-3 px-6 rounded-lg hover:bg-gray-300 transition-colors">
                Go Home
            </a>

            <button onclick="history.back()" class="inline-block w-full bg-gray-100 text-gray-700 font-semibold py-3 px-6 rounded-lg hover:bg-gray-200 transition-colors">
                Go Back
            </button>
        </div>

        <!-- Error ID for Support -->
        @if(config('app.debug'))
            <div class="mt-8 p-4 bg-red-50 rounded-lg">
                <h3 class="text-sm font-semibold text-red-700 mb-2">Debug Information</h3>
                <p class="text-xs text-red-600">
                    Error ID: {{ $exception->getCode() ?? 'Unknown' }}
                </p>
                <p class="text-xs text-red-600 mt-1">
                    {{ $exception->getMessage() }}
                </p>
            </div>
        @endif

        <!-- Footer -->
        <div class="mt-8 text-sm text-gray-500">
            <p>Please try again later or contact support if the problem persists.</p>
        </div>
    </div>
</body>
</html>
