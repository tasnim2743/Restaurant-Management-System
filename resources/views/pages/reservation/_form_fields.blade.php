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