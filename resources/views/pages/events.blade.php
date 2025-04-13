@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative h-[400px]">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=2070&auto=format&fit=crop"
            class="w-full h-full object-cover" alt="Event Space">
        <div class="absolute inset-0 bg-black opacity-60"></div>
    </div>
    <div class="relative flex flex-col items-center justify-center h-full text-white text-center px-4">
        <h1 class="text-4xl md:text-6xl font-serif mb-4">Private Events</h1>
        <p class="text-xl font-serif tracking-wider">CREATE UNFORGETTABLE MEMORIES</p>
    </div>
</div>

<!-- Private Dining Spaces -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-serif text-center mb-12">Our Event Spaces</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Wine Cellar -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="relative h-[300px]">
                    <img src="https://images.unsplash.com/photo-1560624052-449f5ddf0c31?q=80&w=2070&auto=format&fit=crop"
                        alt="Wine Cellar" class="w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-serif mb-2">The Wine Cellar</h3>
                    <p class="text-gray-600 mb-4">
                        An intimate space surrounded by our curated wine collection. Perfect for small gatherings
                        and wine tastings.
                    </p>
                    <ul class="text-gray-600 mb-4">
                        <li>• Capacity: Up to 20 guests</li>
                        <li>• Private bar</li>
                        <li>• Wine tasting experiences available</li>
                    </ul>
                </div>
            </div>

            <!-- Garden Terrace -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="relative h-[300px]">
                    <img src="https://www.thespruce.com/thmb/YpYMo0E9kWLDkk46DFUt8ukXNPo=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/GettyImages-1330787547-2546650379c846efaeb3c40196f9340f.jpg"
                        alt="Garden Terrace" class="w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-serif mb-2">The Garden Terrace</h3>
                    <p class="text-gray-600 mb-4">
                        A beautiful outdoor space perfect for al fresco dining and summer celebrations.
                    </p>
                    <ul class="text-gray-600 mb-4">
                        <li>• Capacity: Up to 60 guests</li>
                        <li>• Outdoor bar</li>
                        <li>• Weather contingency options</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Event Types -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-serif text-center mb-12">Special Occasions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Weddings -->
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <div class="text-[#C8A97E] text-4xl mb-4">
                    <i class="fas fa-rings-wedding"></i>
                </div>
                <h3 class="text-xl font-serif mb-4">Wedding Events</h3>
                <p class="text-gray-600 mb-4">
                    From intimate ceremonies to grand receptions, we'll make your special day unforgettable.
                </p>
                <ul class="text-gray-600">
                    <li>• Custom menus</li>
                    <li>• Wedding cake service</li>
                    <li>• Dedicated event coordinator</li>
                </ul>
            </div>

            <!-- Corporate -->
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <div class="text-[#C8A97E] text-4xl mb-4">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3 class="text-xl font-serif mb-4">Corporate Events</h3>
                <p class="text-gray-600 mb-4">
                    Professional settings for meetings, presentations, and corporate celebrations.
                </p>
                <ul class="text-gray-600">
                    <li>• AV equipment available</li>
                    <li>• Business lunch packages</li>
                    <li>• Team building activities</li>
                </ul>
            </div>

            <!-- Private Parties -->
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <div class="text-[#C8A97E] text-4xl mb-4">
                    <i class="fas fa-glass-cheers"></i>
                </div>
                <h3 class="text-xl font-serif mb-4">Private Celebrations</h3>
                <p class="text-gray-600 mb-4">
                    Birthday parties, anniversaries, or any special occasion worth celebrating.
                </p>
                <ul class="text-gray-600">
                    <li>• Customizable decorations</li>
                    <li>• Special occasion cakes</li>
                    <li>• Entertainment options</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Catering Services -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-serif mb-6">Catering Services</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Bring the taste of Italy to your location. Our catering services provide the same
                    exceptional quality and service you've come to expect from our restaurant.
                </p>
                <ul class="text-gray-600 space-y-4">
                    <li class="flex items-center">
                        <i class="fas fa-check text-[#C8A97E] mr-2"></i>
                        Full-service catering available
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-[#C8A97E] mr-2"></i>
                        Custom menu planning
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-[#C8A97E] mr-2"></i>
                        Professional staff and equipment
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-[#C8A97E] mr-2"></i>
                        Setup and cleanup included
                    </li>
                </ul>
            </div>
            <div class="rounded-lg overflow-hidden shadow-lg">
                <img src="https://images.unsplash.com/photo-1555244162-803834f70033?q=80&w=2070&auto=format&fit=crop"
                    alt="Catering Service" class="w-full h-[400px] object-cover">
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA -->
<section class="relative py-20">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1533777857889-4be7c70b33f7?q=80&w=2070&auto=format&fit=crop"
            class="w-full h-full object-cover" alt="Event Setup">
        <div class="absolute inset-0 bg-black opacity-70"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h2 class="text-3xl font-serif mb-6">Plan Your Event</h2>
        <p class="text-gray-300 mb-8 max-w-2xl mx-auto font-serif">
            Contact our events team to start planning your perfect occasion.
        </p>
        <a href="{{ route('reservations.create') }}"
            class="inline-block bg-[#C8A97E] text-white px-8 py-3 font-serif uppercase tracking-wider hover:bg-[#B69A71] transition duration-300">
            Make a Reservation
        </a>
    </div>
</section>
@endsection