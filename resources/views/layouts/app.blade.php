<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">

        <aside class="w-64 bg-white border-r border-gray-200 hidden md:block fixed h-full z-10">
            <div class="h-16 flex items-center justify-center border-b border-gray-200">
                <h1 class="text-xl font-bold text-blue-600">ADMIN BEM</h1>
            </div>

            <nav class="mt-5 px-4 space-y-2">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-2 text-gray-700 bg-gray-100 rounded-lg group {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 font-bold' : 'hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                    Dashboard
                </a>

                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-4 mb-2">Master Data</p>

                <a href="{{ route('cabinets.index') }}"
                    class="flex items-center px-4 py-2 text-gray-600 rounded-lg group {{ request()->routeIs('cabinets*') ? 'bg-blue-50 text-blue-700 font-bold' : 'hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Data Kabinet
                </a>

                <a href="{{ route('penguruses.index') }}"
                    class="flex items-center px-4 py-2 text-gray-600 rounded-lg group {{ request()->routeIs('penguruses*') ? 'bg-blue-50 text-blue-700 font-bold' : 'hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    Data Pengurus
                </a>

                <a href="{{ route('departements.index') }}"
                    class="flex items-center px-4 py-2 text-gray-600 rounded-lg group {{ request()->routeIs('departements*') ? 'bg-blue-50 text-blue-700 font-bold' : 'hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                    Departemen
                </a>
            </nav>
        </aside>

        <main class="flex-1 md:ml-64">
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 sticky top-0 z-10">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $header ?? 'Dashboard' }}
                </h2>

                <div class="relative flex items-center">
                    <div class="mr-4 text-sm text-gray-600">{{ Auth::user()->name }}</div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-semibold">
                            Log Out
                        </button>
                    </form>
                </div>
            </header>

            <div class="py-6 px-6">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>
