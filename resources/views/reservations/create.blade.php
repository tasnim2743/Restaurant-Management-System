@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-serif text-gray-900">Make a Reservation</h1>
            <p class="mt-2 text-gray-600">Book your table at Trattoria for an unforgettable dining experience</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Reservation Form -->
            <div class="md:col-span-2">
                <div class="bg-white shadow-lg rounded-lg p-6 space-y-6">
                    <form action="{{ route('reservations.store') }}" method="POST" id="reservationForm">
                        @csrf

                        <!-- Customer Information -->
                        <div class="space-y-4">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-[#C8A97E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Customer Information
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="customer_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <input type="text" name="customer_name" id="customer_name" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#C8A97E] focus:ring-[#C8A97E] sm:text-sm"
                                        value="{{ old('customer_name', Auth::user()->name) }}">
                                    @error('customer_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                    <input type="email" name="email" id="email" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#C8A97E] focus:ring-[#C8A97E] sm:text-sm"
                                        value="{{ old('email', Auth::user()->email) }}">
                                    @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                    <input type="tel" name="phone" id="phone" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#C8A97E] focus:ring-[#C8A97E] sm:text-sm"
                                        value="{{ old('phone', Auth::user()->phone) }}">
                                    @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="number_of_guests" class="block text-sm font-medium text-gray-700">Number of Guests</label>
                                    <select name="number_of_guests" id="number_of_guests" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#C8A97E] focus:ring-[#C8A97E] sm:text-sm">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}" {{ old('number_of_guests') == $i ? 'selected' : '' }}>
                                            {{ $i }} {{ $i === 1 ? 'Guest' : 'Guests' }}
                                            </option>
                                            @endfor
                                    </select>
                                    @error('number_of_guests')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Reservation Details -->
                        <div class="mt-8 space-y-4">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-[#C8A97E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Reservation Details
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="reservation_date" class="block text-sm font-medium text-gray-700">Date</label>
                                    <input type="date" name="reservation_date" id="reservation_date" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#C8A97E] focus:ring-[#C8A97E] sm:text-sm"
                                        min="{{ date('Y-m-d') }}"
                                        value="{{ old('reservation_date') }}">
                                    @error('reservation_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="reservation_time" class="block text-sm font-medium text-gray-700">Time</label>
                                    <select name="reservation_time" id="reservation_time" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#C8A97E] focus:ring-[#C8A97E] sm:text-sm">
                                        @foreach(range(11, 22) as $hour)
                                        @foreach(['00', '30'] as $minute)
                                        <option value="{{ sprintf('%02d', $hour) }}:{{ $minute }}"
                                            {{ old('reservation_time') == sprintf('%02d', $hour) . ':' . $minute ? 'selected' : '' }}>
                                            {{ sprintf('%02d', $hour) }}:{{ $minute }}
                                        </option>
                                        @endforeach
                                        @endforeach
                                    </select>
                                    @error('reservation_time')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div id="available-tables" class="mt-4 hidden">
                                <label class="block text-sm font-medium text-gray-700">Available Tables</label>
                                <div class="mt-2 grid grid-cols-2 gap-4" id="table-options">
                                    <!-- Tables will be populated dynamically -->
                                </div>
                            </div>
                        </div>

                        <!-- Special Requests -->
                        <div class="mt-8 space-y-4">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-[#C8A97E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Additional Requests
                            </h2>

                            <div>
                                <textarea name="special_requests" id="special_requests" rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#C8A97E] focus:ring-[#C8A97E] sm:text-sm"
                                    placeholder="Any special requests or dietary requirements...">{{ old('special_requests') }}</textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8 flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-[#C8A97E] hover:bg-[#B69A71] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#C8A97E]">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Confirm Reservation
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar Information -->
            <div class="md:col-span-1">
                <div class="bg-white shadow-lg rounded-lg p-6 space-y-6">
                    <!-- Restaurant Hours -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#C8A97E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Opening Hours
                        </h3>
                        <div class="mt-2 space-y-2 text-sm text-gray-600">
                            <p>Monday - Friday: 11:00 - 23:00</p>
                            <p>Saturday - Sunday: 10:00 - 23:00</p>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#C8A97E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            Contact Us
                        </h3>
                        <!-- <div class="mt-2 space-y-2 text-sm text-gray-600">
                            <p>Phone: +1 (234) 567-8900</p>
                            <p>Email: reservations@trattoria.com</p>
                        </div> -->
                    </div>

                    <!-- Reservation Policy -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#C8A97E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Reservation Policy
                        </h3>
                        <div class="mt-2 space-y-2 text-sm text-gray-600">
                            <p>• Reservations can be made up to 30 days in advance</p>
                            <p>• Please arrive 10 minutes before your reservation time</p>
                            <p>• Tables will be held for 15 minutes after reservation time</p>
                            <p>• Cancellations must be made 24 hours in advance</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('reservationForm');
        const dateInput = document.getElementById('reservation_date');
        const timeInput = document.getElementById('reservation_time');
        const guestsInput = document.getElementById('number_of_guests');
        const availableTablesDiv = document.getElementById('available-tables');
        const tableOptionsDiv = document.getElementById('table-options');

        function checkAvailability() {
            const date = dateInput.value;
            const time = timeInput.value;
            const guests = guestsInput.value;

            if (!date || !time || !guests) return;

            fetch(`/reservations/check-availability?reservation_date=${date} ${time}&number_of_guests=${guests}`)
                .then(response => response.json())
                .then(data => {
                    availableTablesDiv.classList.remove('hidden');
                    tableOptionsDiv.innerHTML = '';

                    if (data.available && data.tables.length > 0) {
                        data.tables.forEach(table => {
                            const tableCard = document.createElement('div');
                            tableCard.className = 'relative flex items-start p-4 border rounded-lg cursor-pointer hover:border-[#C8A97E]';
                            tableCard.innerHTML = `
                            <div class="flex h-5 items-center">
                                <input type="radio" name="table_id" value="${table.id}" required
                                    class="h-4 w-4 border-gray-300 text-[#C8A97E] focus:ring-[#C8A97E]">
                            </div>
                            <div class="ml-3 text-sm">
                                <label class="font-medium text-gray-700">Table #${table.table_number}</label>
                                <p class="text-gray-500">Capacity: ${table.capacity} guests</p>
                                <p class="text-gray-500">${table.location}</p>
                            </div>
                        `;
                            tableOptionsDiv.appendChild(tableCard);
                        });
                    } else {
                        tableOptionsDiv.innerHTML = `
                        <div class="col-span-2 p-4 text-center text-red-600 bg-red-50 rounded-lg">
                            No tables available for the selected time and party size.
                            Please try a different time or date.
                        </div>
                    `;
                    }
                });
        }

        dateInput.addEventListener('change', checkAvailability);
        timeInput.addEventListener('change', checkAvailability);
        guestsInput.addEventListener('change', checkAvailability);
    });
</script>
@endpush
@endsection