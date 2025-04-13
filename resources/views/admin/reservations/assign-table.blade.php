@extends('layouts.admin')

@section('title', 'Assign Table')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold">Assign Table for Reservation #{{ $reservation->id }}</h2>
        <p class="text-gray-600">
            Guest: {{ $reservation->user->name }} |
            Date: {{ $reservation->reservation_time->format('Y-m-d') }} |
            Time: {{ $reservation->reservation_time->format('H:i') }} |
            Guests: {{ $reservation->number_of_guests }}
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($availableTables as $table)
        <div class="bg-white rounded-lg shadow p-6 {{ $table->capacity < $reservation->number_of_guests ? 'opacity-50' : '' }}">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-xl font-semibold">Table #{{ $table->table_number }}</h3>
                    <p class="text-gray-600">Capacity: {{ $table->capacity }} persons</p>
                </div>
                @if($table->capacity >= $reservation->number_of_guests)
                <form action="{{ route('admin.reservations.assign-table', $reservation) }}" method="POST">
                    @csrf
                    <input type="hidden" name="table_id" value="{{ $table->id }}">
                    <button type="submit" class="bg-gold text-white px-4 py-2 rounded hover:bg-opacity-90">
                        Assign
                    </button>
                </form>
                @else
                <span class="text-red-500 text-sm">Insufficient capacity</span>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection