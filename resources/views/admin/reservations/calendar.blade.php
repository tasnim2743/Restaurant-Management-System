@extends('layouts.admin')

@section('title', 'Reservation Calendar')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-semibold">Reservation Calendar</h2>
        <div class="flex space-x-4">
            <button onclick="previousWeek()" class="px-4 py-2 border rounded">&larr; Previous</button>
            <span id="currentWeek" class="py-2">{{ now()->startOfWeek()->format('M d') }} - {{ now()->endOfWeek()->format('M d, Y') }}</span>
            <button onclick="nextWeek()" class="px-4 py-2 border rounded">Next &rarr;</button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b text-left">Table</th>
                    @for($i = 0; $i < 7; $i++)
                        <th class="px-6 py-3 border-b text-left">
                        {{ now()->startOfWeek()->addDays($i)->format('D, M d') }}
                        </th>
                        @endfor
                </tr>
            </thead>
            <tbody>
                @foreach($tables as $table)
                <tr>
                    <td class="px-6 py-4 border-b">Table #{{ $table->table_number }}</td>
                    @for($i = 0; $i < 7; $i++)
                        <td class="px-6 py-4 border-b">
                        @foreach($reservations->where('table_id', $table->id)->where('date', now()->startOfWeek()->addDays($i)->format('Y-m-d')) as $reservation)
                        <div class="mb-2 p-2 rounded {{ $reservation->status === 'confirmed' ? 'bg-green-100' : 'bg-yellow-100' }}">
                            <div class="text-sm font-semibold">{{ $reservation->reservation_time->format('H:i') }}</div>
                            <div class="text-sm">{{ $reservation->user->name }}</div>
                            <div class="text-xs text-gray-600">{{ $reservation->number_of_guests }} guests</div>
                        </div>
                        @endforeach
                        </td>
                        @endfor
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
    let currentWeekStart = new Date();
    currentWeekStart.setDate(currentWeekStart.getDate() - currentWeekStart.getDay());

    function updateCalendar() {
        fetch(`/admin/reservations/calendar-data?start=${currentWeekStart.toISOString()}`)
            .then(response => response.json())
            .then(data => {
                // Update calendar with new data
                // Implementation details here
            });
    }

    function previousWeek() {
        currentWeekStart.setDate(currentWeekStart.getDate() - 7);
        updateCalendar();
    }

    function nextWeek() {
        currentWeekStart.setDate(currentWeekStart.getDate() + 7);
        updateCalendar();
    }
</script>
@endpush
@endsection