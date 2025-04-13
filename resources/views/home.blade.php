@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative h-screen">
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-bg.jpg') }}" class="w-full h-full object-cover" alt="Restaurant Background">
        <div class="absolute inset-0 bg-black opacity-50"></div>
    </div>
    <div class="relative flex flex-col items-center justify-center h-full text-white text-center">
        <h1 class="text-5xl font-serif mb-4">The Italian Restaurant</h1>
        <p class="text-xl mb-8">AUTHENTIC ITALIAN CUISINE</p>
        <a href="{{ route('reservations') }}" class="bg-[#C8A97E] text-white px-8 py-3 rounded hover:bg-[#B69A71]">
            Make a Reservation
        </a>
    </div>
</div>

<!-- Our Story Section -->
<div class="max-w-7xl mx-auto px-4 py-16 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
    <div>
        <img src="{{ asset('images/ingredients.jpg') }}" alt="Fresh Ingredients" class="rounded-lg shadow-lg">
    </div>
    <div>
        <h2 class="text-3xl font-serif mb-6">Our Story</h2>
        <p class="text-gray-600">For over thirty decades, we've been bringing the authentic flavors of Italy to your table. Our commitment to quality ingredients and traditional Italian recipes sets us apart...</p>
    </div>
</div>

<!-- Featured Dishes -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-serif text-center mb-12">Featured Dishes</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="relative group">
                <img src="{{ asset('images/menu/pasta.jpg') }}" alt="Homemade Pasta" class="w-full h-64 object-cover rounded-lg">
                <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition rounded-lg flex items-end">
                    <h3 class="text-white text-xl p-4">Homemade Pasta</h3>
                </div>
            </div>
            <!-- Add more featured dishes -->
        </div>
    </div>
</div>

<!-- Wine & Dining Section -->
<div class="max-w-7xl mx-auto px-4 py-16">
    <h2 class="text-3xl font-serif text-center mb-12">Wine & Dining</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
            <img src="{{ asset('images/wine.jpg') }}" alt="Wine Selection" class="rounded-lg shadow-lg mb-4">
            <h3 class="text-xl font-semibold mb-2">Curated Wine Selection</h3>
            <p class="text-gray-600">Explore our extensive wine selection featuring premium Italian wines...</p>
        </div>
        <div>
            <img src="{{ asset('images/private-dining.jpg') }}" alt="Private Dining" class="rounded-lg shadow-lg mb-4">
            <h3 class="text-xl font-semibold mb-2">Private Dining</h3>
            <p class="text-gray-600">Host your special occasions in our elegant private dining room...</p>
        </div>
    </div>
</div>
@endsection