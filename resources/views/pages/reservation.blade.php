@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFBF7]">
    <!-- Hero Section -->
    <div class="relative h-96">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0" alt="Restaurant Interior" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black opacity-50"></div>
        </div>
        <div class="relative flex items-center justify-center h-full">
            <div class="text-center">
                <h1 class="font-serif text-7xl text-white mb-4 italic">Prenota un Tavolo</h1>
                <p class="text-xl text-white font-light">Reserve Your Perfect Dining Experience</p>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Reservation Form or Login Prompt -->
            <div class="md:col-span-2">
                @guest
                <div class="bg-white p-8 rounded-lg shadow-xl text-center">
                    <h2 class="font-serif text-2xl mb-4 text-gray-800">Login Required</h2>
                    <p class="text-gray-600 mb-6">Please login or create an account to make a reservation.</p>
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="inline-block bg-[#C8A97E] text-white px-6 py-3 rounded-md hover:bg-[#B69A6D] transition duration-300">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="inline-block bg-gray-800 text-white px-6 py-3 rounded-md hover:bg-gray-700 transition duration-300">
                            Register
                        </a>
                    </div>
                </div>
                @else
                <div class="bg-white p-8 rounded-lg shadow-xl">
                    @if ($errors->has('unavailable'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-md">
                        {{ $errors->first('unavailable') }}
                    </div>
                    @endif

                    @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-600 rounded-md">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('reservations.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Personal Information -->
                        <div class="mb-8">
                            <h2 class="font-serif text-2xl mb-6 text-gray-800 border-b pb-2">Personal Information</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                    <input type="text" id="name" name="name" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:border-[#C8A97E] focus:ring-[#C8A97E] transition-colors"
                                        value="{{ old('name', Auth::user()->name) }}">
                                    @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                    <input type="email" id="email" name="email" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:border-[#C8A97E] focus:ring-[#C8A97E] transition-colors"
                                        value="{{ old('email', Auth::user()->email) }}">
                                    @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <input type="tel" id="phone" name="phone" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:border-[#C8A97E] focus:ring-[#C8A97E] transition-colors"
                                        value="{{ old('phone', Auth::user()->phone) }}">
                                    @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Reservation Details -->
                        <div class="mb-8">
                            <h2 class="font-serif text-2xl mb-6 text-gray-800 border-b pb-2">Reservation Details</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Date -->
                                <div>
                                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                    <input type="date" id="date" name="date" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:border-[#C8A97E] focus:ring-[#C8A97E] transition-colors"
                                        value="{{ old('date') }}"
                                        min="{{ date('Y-m-d') }}">
                                    @error('date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Time -->
                                <div>
                                    <label for="time" class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                                    <select id="time" name="time" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:border-[#C8A97E] focus:ring-[#C8A97E] transition-colors">
                                        <option value="">Select a time</option>
                                        <option value="11:00">11:00 AM</option>
                                        <option value="11:30">11:30 AM</option>
                                        <option value="12:00">12:00 PM</option>
                                        <option value="12:30">12:30 PM</option>
                                        <option value="13:00">1:00 PM</option>
                                        <option value="13:30">1:30 PM</option>
                                        <option value="14:00">2:00 PM</option>
                                        <option value="14:30">2:30 PM</option>
                                        <option value="15:00">3:00 PM</option>
                                        <option value="15:30">3:30 PM</option>
                                        <option value="16:00">4:00 PM</option>
                                        <option value="16:30">4:30 PM</option>
                                        <option value="17:00">5:00 PM</option>
                                        <option value="17:30">5:30 PM</option>
                                        <option value="18:00">6:00 PM</option>
                                        <option value="18:30">6:30 PM</option>
                                        <option value="19:00">7:00 PM</option>
                                        <option value="19:30">7:30 PM</option>
                                        <option value="20:00">8:00 PM</option>
                                        <option value="20:30">8:30 PM</option>
                                        <option value="21:00">9:00 PM</option>
                                    </select>
                                    @error('time')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Guests -->
                                <div>
                                    <label for="guests" class="block text-sm font-medium text-gray-700 mb-1">Number of Guests</label>
                                    <select id="guests" name="guests" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:border-[#C8A97E] focus:ring-[#C8A97E] transition-colors">
                                        <option value="">Select number of guests</option>
                                        @for($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}" {{ old('guests') == $i ? 'selected' : '' }}>
                                            {{ $i }} {{ $i === 1 ? 'Guest' : 'Guests' }}
                                            </option>
                                            @endfor
                                    </select>
                                    @error('guests')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Special Requests -->
                        <div class="mb-8">
                            <h2 class="font-serif text-2xl mb-6 text-gray-800 border-b pb-2">Additional Information</h2>
                            <div>
                                <label for="special_requests" class="block text-sm font-medium text-gray-700 mb-1">Special Requests</label>
                                <textarea id="special_requests" name="special_requests" rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:border-[#C8A97E] focus:ring-[#C8A97E] transition-colors"
                                    placeholder="Any special requests or dietary requirements...">{{ old('special_requests') }}</textarea>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-[#C8A97E] text-white px-8 py-4 rounded-md hover:bg-[#B69A6D] transition duration-300 font-serif text-lg">
                            Confirm Reservation
                        </button>
                    </form>
                </div>
                @endguest
            </div>

            <!-- Sidebar Information -->
            <div class="space-y-6">
                <!-- Restaurant Information -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="font-serif text-xl mb-4 text-gray-800 border-b pb-2">Opening Hours</h3>
                    <div class="space-y-2 text-gray-600">
                        <p>Monday - Sunday</p>
                        <p class="font-medium">11:00 AM - 10:00 PM</p>
                        <p class="text-sm text-gray-500 mt-2">Last seating at 9:00 PM</p>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="font-serif text-xl mb-4 text-gray-800 border-b pb-2">Contact Us</h3>
                    <!-- <div class="space-y-2 text-gray-600">
                        <p><span class="font-medium">Phone:</span> +1 (234) 567-8900</p>
                        <p><span class="font-medium">Email:</span> reservations@trattoria.com</p>
                        <p><span class="font-medium">Address:</span> 123 Italian Street, Foodville, FC 12345</p>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection