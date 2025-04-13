<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PublicReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['create']);
    }

    public function create()
    {
        return view('pages.reservation');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('message', 'Please login or register to make a reservation.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date|after:today',
            'time' => 'required',
            'guests' => 'required|integer|min:1|max:10',
            'special_requests' => 'nullable|string|max:1000',
        ]);

        // Combine date and time
        $reservationDateTime = Carbon::parse($validated['date'] . ' ' . $validated['time']);

        // Find an available table that can accommodate the party
        $availableTable = Table::where('capacity', '>=', $validated['guests'])
            ->where('status', '!=', 'maintenance')
            ->whereDoesntHave('reservations', function ($query) use ($reservationDateTime) {
                $query->where('status', '!=', 'cancelled')
                    ->where('reservation_date', $reservationDateTime);
            })
            ->first();

        if (!$availableTable) {
            return back()
                ->withInput()
                ->withErrors(['unavailable' => 'Sorry, we don\'t have any available tables for the selected date and time. Please try a different time or contact us directly.']);
        }

        // Create the reservation
        Reservation::create([
            'user_id' => Auth::id(),
            'customer_name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'number_of_guests' => $validated['guests'],
            'reservation_date' => $reservationDateTime,
            'special_requests' => $validated['special_requests'] ?? null,
            'table_id' => $availableTable->id,
            'status' => 'pending'
        ]);

        return redirect()->route('reservations.create')
            ->with('success', 'Your reservation request has been submitted! We will contact you shortly to confirm your reservation.');
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after:today',
            'time' => 'required',
            'guests' => 'required|integer|min:1|max:20'
        ]);

        $reservationDateTime = Carbon::parse($request->date . ' ' . $request->time);

        // Find available tables that can accommodate the party
        $availableTables = Table::where('capacity', '>=', $request->guests)
            ->where('status', '!=', 'maintenance')
            ->whereDoesntHave('reservations', function ($query) use ($reservationDateTime) {
                $query->where('status', '!=', 'cancelled')
                    ->where('reservation_date', $reservationDateTime);
            })
            ->get();

        // Group tables by capacity for better display
        $tablesByCapacity = $availableTables->groupBy('capacity')->map->count();

        return response()->json([
            'available' => $availableTables->isNotEmpty(),
            'total_tables' => $availableTables->count(),
            'tables_by_capacity' => $tablesByCapacity,
            'max_capacity' => $availableTables->max('capacity') ?? 0,
            'tables' => $availableTables->map(function ($table) {
                return [
                    'number' => $table->table_number,
                    'capacity' => $table->capacity,
                    'location' => $table->location
                ];
            })
        ]);
    }
}
