<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gray-900 h-screen flex items-center justify-center text-gray-100">
    <div class="max-w-xl w-full bg-gray-800 shadow-lg rounded-lg p-8 text-center border border-gray-700">
        <h1 class="text-6xl font-bold text-indigo-500 mb-4">404</h1>
        <h2 class="text-2xl font-semibold text-white mb-4">Page Not Found</h2>
        <p class="text-gray-400 mb-8">
            The page you are looking for does not exist or has been moved.
        </p>

        <div class="flex justify-center space-x-4">
            <a href="{{ url('/') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">
                Go Home
            </a>
            <a href="{{ url()->previous() }}" class="px-6 py-3 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 transition font-semibold">
                Go Back
            </a>
        </div>
    </div>
</body>
</html>
