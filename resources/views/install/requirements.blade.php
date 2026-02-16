<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Installer - Requirements</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full">
    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Installation Wizard</h2>
            <p class="mt-2 text-center text-sm text-gray-600">Step 1: Server Requirements</p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">PHP Extensions</h3>
                        <ul class="mt-4 space-y-2">
                            @foreach($requirements as $label => $pass)
                                <li class="flex items-center justify-between">
                                    <span class="text-sm text-gray-700">{{ $label }}</span>
                                    @if($pass)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Pass</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Fail</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Permissions</h3>
                        <ul class="mt-4 space-y-2">
                            @foreach($permissions as $label => $pass)
                                <li class="flex items-center justify-between">
                                    <span class="text-sm text-gray-700">{{ $label }}</span>
                                    @if($pass)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Writable</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Not Writable</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="flex justify-end">
                        @if(!in_array(false, $requirements) && !in_array(false, $permissions))
                            <a href="{{ route('install.database') }}" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Next Step: Database
                            </a>
                        @else
                            <button disabled class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-400 cursor-not-allowed">
                                Please fix issues to proceed
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
