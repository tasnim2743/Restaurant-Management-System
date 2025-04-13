@extends('layouts.admin')

@section('title', 'Table Layout')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold">Table Layout</h2>
        <div class="flex space-x-4">
            <input type="date" id="dateFilter" value="{{ date('Y-m-d') }}"
                class="border rounded px-3 py-2"
                onchange="updateTableStatus(this.value)">
            <div class="flex items-center space-x-2">
                <span class="w-4 h-4 bg-green-500 rounded-full"></span>
                <span class="text-sm">Available</span>
                <span class="w-4 h-4 bg-red-500 rounded-full ml-4"></span>
                <span class="text-sm">Occupied</span>
                <span class="w-4 h-4 bg-yellow-500 rounded-full ml-4"></span>
                <span class="text-sm">Reserved</span>
            </div>
        </div>
    </div>
</div>

<!-- Restaurant Layout Grid -->
<div class="grid grid-cols-4 gap-6" id="tableLayout">
    @foreach($tables as $table)
    <div id="table-{{ $table->id }}"
        class="relative p-6 bg-white rounded-lg shadow-lg cursor-pointer hover:shadow-xl transition-shadow"
        onclick="showTableDetails({{ $table->id }})">
        <div class="absolute top-2 right-2 w-3 h-3 rounded-full 
            {{ $table->is_available ? 'bg-green-500' : 'bg-red-500' }}"></div>
        <div class="text-center">
            <h3 class="text-xl font-semibold">Table {{ $table->table_number }}</h3>
            <p class="text-gray-600">{{ $table->capacity }} Seats</p>
            <div class="mt-2 text-sm" id="table-status-{{ $table->id }}">
                @if($table->currentReservation)
                Reserved: {{ $table->currentReservation->reservation_time->format('H:i') }}
                @else
                Available
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Table Details Modal -->
<div id="tableDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
            <div class="p-6">
                <h3 class="text-xl font-semibold mb-4">Table Details</h3>
                <div id="tableDetailsContent">
                    <!-- Content will be loaded dynamically -->
                </div>
                <div class="mt-6 flex justify-end">
                    <button onclick="closeTableDetails()"
                        class="px-4 py-2 bg-gray-200 rounded">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function updateTableStatus(date) {
        fetch(`/admin/tables/status?date=${date}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(table => {
                    const tableElement = document.getElementById(`table-${table.id}`);
                    const statusElement = document.getElementById(`table-status-${table.id}`);

                    // Update status indicator
                    const indicator = tableElement.querySelector('.rounded-full');
                    indicator.className = `absolute top-2 right-2 w-3 h-3 rounded-full ${
                    table.status === 'available' ? 'bg-green-500' : 
                    table.status === 'reserved' ? 'bg-yellow-500' : 'bg-red-500'
                }`;

                    // Update status text
                    statusElement.textContent = table.statusText;
                });
            });
    }

    function showTableDetails(tableId) {
        fetch(`/admin/tables/${tableId}/details`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('tableDetailsContent').innerHTML = `
                <div class="space-y-4">
                    <p><strong>Table Number:</strong> ${data.table_number}</p>
                    <p><strong>Capacity:</strong> ${data.capacity} persons</p>
                    <p><strong>Status:</strong> ${data.status}</p>
                    ${data.currentReservation ? `
                        <div class="mt-4">
                            <h4 class="font-semibold">Current Reservation</h4>
                            <p>Time: ${data.currentReservation.time}</p>
                            <p>Guest: ${data.currentReservation.guest_name}</p>
                            <p>Guests: ${data.currentReservation.number_of_guests}</p>
                        </div>
                    ` : ''}
                </div>
            `;
                document.getElementById('tableDetailsModal').classList.remove('hidden');
            });
    }

    function closeTableDetails() {
        document.getElementById('tableDetailsModal').classList.add('hidden');
    }

    // Initial load
    updateTableStatus(document.getElementById('dateFilter').value);
</script>
@endpush
@endsection