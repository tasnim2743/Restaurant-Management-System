<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - {{ config('app.name', 'Restaurant') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <div class="p-4">
                <h1 class="text-2xl font-semibold">Admin Panel</h1>
            </div>
            <nav class="mt-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-2 hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-gold text-white' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.reservations') }}"
                    class="block px-4 py-2 hover:bg-gray-100 {{ request()->routeIs('admin.reservations') ? 'bg-gold text-white' : '' }}">
                    Reservations
                </a>
                <a href="{{ route('admin.menu') }}"
                    class="block px-4 py-2 hover:bg-gray-100 {{ request()->routeIs('admin.menu') ? 'bg-gold text-white' : '' }}">
                    Menu Items
                </a>
                <a href="{{ route('admin.tables') }}"
                    class="block px-4 py-2 hover:bg-gray-100 {{ request()->routeIs('admin.tables') ? 'bg-gold text-white' : '' }}">
                    Tables
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto">
            <header class="bg-white shadow">
                <div class="px-6 py-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold">@yield('title')</h2>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-900">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>