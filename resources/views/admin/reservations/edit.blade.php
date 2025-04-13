@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Edit Reservation</h2>
                    <p class="mt-1 text-sm text-gray-600">Modify reservation details for {{ $reservation->customer_name }}</p>
                </div>

                <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST" class="max-w-2xl">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <!-- Customer Information -->
                        <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                            <h3 class="text-lg font-medium text-gray-900">Customer Information</h3>

                            <!-- Name -->
                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <div class="mt-1">
                                    <input type="text" name="customer_name" id="customer_name" required
                                        class="shadow-sm focus:ring-[#C8A97E] focus:border-[#C8A97E] block w-full sm:text-sm border-gray-300 rounded-md"
                                        value="{{ old('customer_name', $reservation->customer_name) }}">
                                </div>
                                @error('customer_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                <div class="mt-1">
                                    <input type="email" name="email" id="email" required
                                        class="shadow-sm focus:ring-[#C8A97E] focus:border-[#C8A97E] block w-full sm:text-sm border-gray-300 rounded-md"
                                        value="{{ old('email', $reservation->email) }}">
                                </div>
                                @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <div class="mt-1">
                                    <input type="tel" name="phone" id="phone" required
                                        class="shadow-sm focus:ring-[#C8A97E] focus:border-[#C8A97E] block w-full sm:text-sm border-gray-300 rounded-md"
                                        value="{{ old('phone', $reservation->phone) }}">
                                </div>
                                @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Reservation Details -->
                        <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                            <h3 class="text-lg font-medium text-gray-900">Reservation Details</h3>

                            <!-- Date and Time -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="reservation_date" class="block text-sm font-medium text-gray-700">Date</label>
                                    <div class="mt-1">
                                        <input type="date" name="reservation_date" id="reservation_date" required
                                            class="shadow-sm focus:ring-[#C8A97E] focus:border-[#C8A97E] block w-full sm:text-sm border-gray-300 rounded-md"
                                            value="{{ old('reservation_date', $reservation->reservation_date->format('Y-m-d')) }}"
                                            min="{{ date('Y-m-d') }}">
                                    </div>
                                    @error('reservation_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="reservation_time" class="block text-sm font-medium text-gray-700">Time</label>
                                    <div class="mt-1">
                                        <input type="time" name="reservation_time" id="reservation_time" required
                                            class="shadow-sm focus:ring-[#C8A97E] focus:border-[#C8A97E] block w-full sm:text-sm border-gray-300 rounded-md"
                                            value="{{ old('reservation_time', $reservation->reservation_date->format('H:i')) }}"
                                            min="11:00" max="22:00">
                                    </div>
                                    @error('reservation_time')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Number of Guests -->
                            <div>
                                <label for="number_of_guests" class="block text-sm font-medium text-gray-700">Number of Guests</label>
                                <div class="mt-1">
                                    <input type="number" name="number_of_guests" id="number_of_guests" required min="1" max="20"
                                        class="shadow-sm focus:ring-[#C8A97E] focus:border-[#C8A97E] block w-full sm:text-sm border-gray-300 rounded-md"
                                        value="{{ old('number_of_guests', $reservation->number_of_guests) }}">
                                </div>
                                @error('number_of_guests')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Table Selection -->
                            <div>
                                <label for="table_id" class="block text-sm font-medium text-gray-700">Select Table</label>
                                <div class="mt-1">
                                    <select name="table_id" id="table_id" required
                                        class="shadow-sm focus:ring-[#C8A97E] focus:border-[#C8A97E] block w-full sm:text-sm border-gray-300 rounded-md">
                                        @foreach($tables as $table)
                                        <option value="{{ $table->id }}"
                                            {{ old('table_id', $reservation->table_id) == $table->id ? 'selected' : '' }}
                                            data-capacity="{{ $table->capacity }}">
                                            Table #{{ $table->table_number }} ({{ $table->capacity }} guests) - {{ $table->location }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('table_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                            <h3 class="text-lg font-medium text-gray-900">Additional Information</h3>

                            <!-- Special Requests -->
                            <div>
                                <label for="special_requests" class="block text-sm font-medium text-gray-700">
                                    Special Requests
                                    <span class="text-gray-500">(Optional)</span>
                                </label>
                                <div class="mt-1">
                                    <textarea name="special_requests" id="special_requests" rows="3"
                                        class="shadow-sm focus:ring-[#C8A97E] focus:border-[#C8A97E] block w-full sm:text-sm border-gray-300 rounded-md">{{ old('special_requests', $reservation->special_requests) }}</textarea>
                                </div>
                                @error('special_requests')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Reservation Status</label>
                                <div class="mt-1">
                                    <select name="status" id="status" required
                                        class="shadow-sm focus:ring-[#C8A97E] focus:border-[#C8A97E] block w-full sm:text-sm border-gray-300 rounded-md">
                                        <option value="pending" {{ old('status', $reservation->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ old('status', $reservation->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="cancelled" {{ old('status', $reservation->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        <option value="completed" {{ old('status', $reservation->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </div>
                                @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end space-x-4 pt-4">
                            <a href="{{ route('admin.reservations.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#C8A97E]">
                                Cancel
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#C8A97E] hover:bg-[#B69A71] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#C8A97E]">
                                Update Reservation
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Danger Zone -->
                <div class="mt-10 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-red-600">Danger Zone</h3>
                    <div class="mt-3">
                        <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                onclick="return confirm('Are you sure you want to cancel this reservation? This action cannot be undone.')">
                                Cancel Reservation
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Validate guest count against table capacity
    document.getElementById('table_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const tableCapacity = selectedOption.dataset.capacity;
        const guestCount = document.getElementById('number_of_guests').value;

        if (parseInt(guestCount) > parseInt(tableCapacity)) {
            alert(`Selected table can only accommodate ${tableCapacity} guests.`);
            this.value = '{{ $reservation->table_id }}';
        }
    });

    document.getElementById('number_of_guests').addEventListener('change', function() {
        const tableSelect = document.getElementById('table_id');
        const selectedOption = tableSelect.options[tableSelect.selectedIndex];

        if (selectedOption.value) {
            const tableCapacity = selectedOption.dataset.capacity;
            if (parseInt(this.value) > parseInt(tableCapacity)) {
                alert(`Selected table can only accommodate ${tableCapacity} guests.`);
                this.value = tableCapacity;
            }
        }
    });
</script>
@endpush
@endsection