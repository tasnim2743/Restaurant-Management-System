<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- <div>
                        <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
                        <p>123 Restaurant Street</p>
                        <p>City, State 12345</p>
                        <p>Phone: (123) 456-7890</p>
                    </div> -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Hours</h3>
                        <p>Monday - Friday: 11:00 AM - 10:00 PM</p>
                        <p>Saturday - Sunday: 10:00 AM - 11:00 PM</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Follow Us</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="hover:text-gray-300">Facebook</a>
                            <a href="#" class="hover:text-gray-300">Instagram</a>
                            <a href="#" class="hover:text-gray-300">Twitter</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Stack Scripts -->
    @stack('scripts')
</body>

</html>