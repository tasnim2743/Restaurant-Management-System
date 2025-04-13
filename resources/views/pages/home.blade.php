@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative h-[600px]">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1514933651103-005eec06c04b?q=80&w=2074&auto=format&fit=crop"
            class="w-full h-full object-cover" alt="Italian Restaurant">
        <div class="absolute inset-0 bg-black opacity-50"></div>
    </div>
    <div class="relative flex flex-col items-center justify-center h-full text-white text-center px-4">
        <h1 class="text-4xl md:text-6xl font-serif mb-4">TRATTORIA</h1>
        <p class="text-xl md:text-2xl mb-8 font-serif tracking-wider">AUTHENTIC ITALIAN CUISINE</p>
        <a href="{{ route('reservations.create') }}"
            class="bg-[#C8A97E] text-white px-8 py-3 font-serif uppercase tracking-wider hover:bg-[#B69A71] transition duration-300">
            Reserve a Table
        </a>
    </div>
</div>

<!-- Our Story Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="rounded-lg overflow-hidden shadow-lg">
                <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=2070&auto=format&fit=crop"
                    alt="Our Story" class="w-full h-[400px] object-cover">
            </div>
            <div>
                <h2 class="text-3xl font-serif mb-6">Our Story</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    For over three decades, we've been bringing the authentic flavors of Italy to your table.
                    Our commitment to quality ingredients and traditional recipes sets us apart,
                    ensuring each dish tells a story of passion and heritage.
                </p>
                <a href="{{ route('story') }}"
                    class="text-[#C8A97E] hover:text-[#B69A71] font-serif uppercase tracking-wider">
                    Read More →
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Menu Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-serif text-center mb-12">Featured Dishes</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Featured Item 1 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="relative h-64">
                    <img src="https://images.unsplash.com/photo-1551183053-bf91a1d81141?q=80&w=2032&auto=format&fit=crop"
                        alt="Pasta" class="w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-serif mb-2">Homemade Pasta</h3>
                    <p class="text-gray-600 mb-4">Fresh pasta made daily with traditional techniques</p>
                    <span class="text-[#C8A97E] font-semibold"></span>
                </div>
            </div>
            <!-- Featured Item 2 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="relative h-64">
                    <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=2070&auto=format&fit=crop"
                        alt="Pizza" class="w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-serif mb-2">Wood-Fired Pizza</h3>
                    <p class="text-gray-600 mb-4">Authentic Neapolitan style pizza</p>
                    <span class="text-[#C8A97E] font-semibold"></span>
                </div>
            </div>
            <!-- Featured Item 3 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="relative h-64">
                    <img src="https://images.unsplash.com/photo-1551529674-48920e9b835b?q=80&w=1964&auto=format&fit=crop"
                        alt="Dessert" class="w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-serif mb-2">Tiramisu</h3>
                    <p class="text-gray-600 mb-4">Classic Italian dessert made fresh daily</p>
                    <span class="text-[#C8A97E] font-semibold"></span>
                </div>
            </div>
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('menu') }}"
                class="inline-block bg-[#C8A97E] text-white px-8 py-3 font-serif uppercase tracking-wider hover:bg-[#B69A71] transition duration-300">
                View Full Menu
            </a>
        </div>
    </div>
</section>

<!-- Reservation CTA Section -->
<section class="relative py-20">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=2074&auto=format&fit=crop"
            class="w-full h-full object-cover" alt="Restaurant Interior">
        <div class="absolute inset-0 bg-black opacity-70"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h2 class="text-3xl font-serif mb-6">Make a Reservation</h2>
        <p class="text-gray-300 mb-8 max-w-2xl mx-auto font-serif">
            Join us for an unforgettable dining experience. Reserve your table today and
            let us take you on a culinary journey through Italy.
        </p>
        <a href="{{ route('reservations.create') }}"
            class="inline-block bg-[#C8A97E] text-white px-8 py-3 font-serif uppercase tracking-wider hover:bg-[#B69A71] transition duration-300">
            Book a Table
        </a>
    </div>
</section>
@endsection