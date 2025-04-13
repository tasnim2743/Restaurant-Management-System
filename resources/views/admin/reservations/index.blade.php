@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">Reservations</h2>
                    <!-- <a href="{{ route('admin.reservations.create') }}"
                        class="bg-[#C8A97E] text-white px-4 py-2 rounded-md hover:bg-[#B69A71] transition-colors">
                        New Reservation
                    </a> -->
                </div>

                <!-- Filters
                <div class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <select id="status-filter" class="rounded-md border-gray-300 focus:border-[#C8A97E] focus:ring-[#C8A97E]">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="completed">Completed</option>
                    </select>

                    <input type="date" id="date-filter"
                        class="rounded-md border-gray-300 focus:border-[#C8A97E] focus:ring-[#C8A97E]">

                    <input type="text" placeholder="Search by name or email"
                        class="rounded-md border-gray-300 focus:border-[#C8A97E] focus:ring-[#C8A97E]">

                    <button class="bg-gray-100 px-4 py-2 rounded-md hover:bg-gray-200 transition-colors">
                        Apply Filters
                    </button>
                </div> -->

                <!-- Reservations Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Customer
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date & Time
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Table
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Guests
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($reservations as $reservation)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $reservation->customer_name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $reservation->email }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $reservation->phone }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $reservation->reservation_date->format('M d, Y') }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $reservation->reservation_date->format('g:i A') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        Table #{{ $reservation->table->table_number }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $reservation->table->location }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $reservation->number_of_guests }} guests
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($reservation->status == 'confirmed') bg-green-100 text-green-800
                                        @elseif($reservation->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($reservation->status == 'cancelled') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        @if($reservation->status == 'pending')
                                        <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit" class="text-green-600 hover:text-green-900">Confirm</button>
                                        </form>
                                        @endif

                                        <a href="{{ route('admin.reservations.edit', $reservation) }}"
                                            class="text-[#C8A97E] hover:text-[#B69A71]">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Are you sure you want to cancel this reservation?')">
                                                Cancel
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    No reservations found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($reservations->hasPages())
                <div class="mt-4">
                    {{ $reservations->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Filter functionality
    document.getElementById('status-filter').addEventListener('change', function() {
        // Add filter logic here
    });

    document.getElementById('date-filter').addEventListener('change', function() {
        // Add date filter logic here
    });
</script>
@endpush
@endsection