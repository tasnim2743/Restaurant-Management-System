@extends('layouts.app')

@section('content')
<div class="relative">
    <!-- Hero Section -->
    <div class="relative h-[300px] bg-black">
        <img src="https://images.pexels.com/photos/1267320/pexels-photo-1267320.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
            alt="Menu Header" class="w-full h-full object-cover opacity-60">
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl text-white font-serif mb-4">Our Menu</h1>
                <p class="text-lg text-white opacity-90">Discover our culinary delights</p>
            </div>
        </div>
    </div>

    <!-- Menu Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Menu Categories -->
        @foreach($menuItems as $category => $items)
        <div class="mb-12">
            <h2 class="text-3xl font-serif text-gray-900 mb-8 text-center">{{ $category }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($items as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-medium text-gray-900">{{ $item['name'] }}</h3>
                            <!-- <span class="text-lg font-semibold text-[#C8A97E]">৳{{ number_format($item['price'], 2) }}</span> -->
                        </div>
                        <p class="text-gray-600">{{ $item['description'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Reservation CTA -->
<section class="bg-[#1A1A1A] text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-serif mb-6">Join Us for Dinner</h2>
        <p class="text-gray-300 mb-8 max-w-2xl mx-auto font-serif">
            Experience our authentic Italian cuisine in an elegant atmosphere.
            Make your reservation today.
        </p>
        <a href="{{ route('reservations.create') }}"
            class="inline-block bg-[#C8A97E] text-white px-8 py-3 font-serif uppercase tracking-wider hover:bg-[#B69A71] transition duration-300">
            Reserve a Table
        </a>
    </div>
</section>
@endsection