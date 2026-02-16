<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 Forbidden</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gray-100 h-screen flex items-center justify-center">
    <div class="max-w-xl w-full bg-white shadow-lg rounded-lg p-8 text-center">
        <h1 class="text-6xl font-bold text-gray-800 mb-4">403</h1>
        <h2 class="text-2xl font-semibold text-gray-600 mb-4">Unauthorized Action</h2>
        <p class="text-gray-500 mb-8">
            You do not have permission to access this page. 
            If you believe this is an error, please contact the administrator.
        </p>

        <div class="flex justify-center space-x-4">
            <a href="{{ url('/') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                Go Home
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                    Log Out
                </button>
            </form>
        </div>
        
        <div class="mt-8 text-xs text-gray-400">
            <p>Debug Info:</p>
            <p>User ID: {{ auth()->id() }}</p>
            <p>Role: {{ auth()->user()->role ?? 'guest' }}</p>
        </div>
    </div>
</body>
</html>
