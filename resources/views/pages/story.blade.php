@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative h-[400px]">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1466978913421-dad2ebd01d17?q=80&w=2074&auto=format&fit=crop"
            class="w-full h-full object-cover" alt="Restaurant History">
        <div class="absolute inset-0 bg-black opacity-60"></div>
    </div>
    <div class="relative flex flex-col items-center justify-center h-full text-white text-center px-4">
        <h1 class="text-4xl md:text-6xl font-serif mb-4">Our Story</h1>
        <p class="text-xl font-serif tracking-wider">A TRADITION OF EXCELLENCE SINCE 1990</p>
    </div>
</div>

<!-- History Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="rounded-lg overflow-hidden shadow-lg">
                <img src="https://images.unsplash.com/photo-1551218808-94e220e084d2?q=80&w=2070&auto=format&fit=crop"
                    alt="Restaurant Founder" class="w-full h-[400px] object-cover">
            </div>
            <div>
                <h2 class="text-3xl font-serif mb-6">Our Beginning</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Founded in 1990, our restaurant began with a simple vision: to bring authentic Italian flavors to our community.
                    What started as a small family-run trattoria has grown into one of the city's most beloved dining destinations,
                    while maintaining the warmth and personal touch that made us special from day one.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    Our founder's passion for traditional Italian cooking, learned in the kitchens of Florence and Rome,
                    continues to inspire every dish we serve today.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-serif text-center mb-12">Our Values</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <div class="text-[#C8A97E] text-4xl mb-4">
                    <i class="fas fa-heart"></i>
                </div>
                <h3 class="text-xl font-serif mb-4">Passion for Food</h3>
                <p class="text-gray-600">
                    We believe in using only the finest ingredients, preparing each dish with care and attention to detail
                    that honors traditional Italian cooking methods.
                </p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <div class="text-[#C8A97E] text-4xl mb-4">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="text-xl font-serif mb-4">Family & Community</h3>
                <p class="text-gray-600">
                    Every guest who walks through our doors becomes part of our extended family.
                    We create not just meals, but memories that bring people together.
                </p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <div class="text-[#C8A97E] text-4xl mb-4">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3 class="text-xl font-serif mb-4">Quality & Sustainability</h3>
                <p class="text-gray-600">
                    We partner with local suppliers and maintain strong relationships with Italian importers to ensure
                    the highest quality ingredients while supporting sustainable practices.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-serif text-center mb-12">Meet Our Team</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="flex items-center space-x-8">
                <div class="w-1/3">
                    <img src="https://images.unsplash.com/photo-1577219491135-ce391730fb2c?q=80&w=2077&auto=format&fit=crop"
                        alt="Head Chef" class="rounded-lg shadow-lg w-full h-[200px] object-cover">
                </div>
                <div class="w-2/3">
                    <h3 class="text-xl font-serif mb-2">Head Chef Marco</h3>
                    <p class="text-gray-600">
                        With over 20 years of experience in traditional Italian cuisine, Chef Marco brings authentic
                        flavors and techniques from his hometown in Tuscany to every dish.
                    </p>
                </div>
            </div>
            <div class="flex items-center space-x-8">
                <div class="w-1/3">
                    <img src="https://images.unsplash.com/photo-1442544213729-6a15f1611937?q=80&w=2072&auto=format&fit=crop"
                        alt="Pastry Chef" class="rounded-lg shadow-lg w-full h-[200px] object-cover">
                </div>
                <div class="w-2/3">
                    <h3 class="text-xl font-serif mb-2">Pastry Chef Sofia</h3>
                    <p class="text-gray-600">
                        A master of Italian desserts, Sofia creates sweet masterpieces that perfectly balance
                        traditional recipes with modern presentation.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Reservation CTA -->
<section class="relative py-20">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1424847651672-bf20a4b0982b?q=80&w=2070&auto=format&fit=crop"
            class="w-full h-full object-cover" alt="Restaurant Interior">
        <div class="absolute inset-0 bg-black opacity-70"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h2 class="text-3xl font-serif mb-6">Experience Our Story</h2>
        <p class="text-gray-300 mb-8 max-w-2xl mx-auto font-serif">
            Join us for an unforgettable dining experience where every dish tells a story of tradition,
            passion, and excellence.
        </p>
        <a href="{{ route('reservations.create') }}"
            class="inline-block bg-[#C8A97E] text-white px-8 py-3 font-serif uppercase tracking-wider hover:bg-[#B69A71] transition duration-300">
            Make a Reservation
        </a>
    </div>
</section>
@endsection