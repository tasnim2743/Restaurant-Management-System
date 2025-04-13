<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Auth::check()
            ? Auth::user()->reservations()->latest()->get()
            : collect();

        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $tables = Table::where('status', '!=', 'maintenance')
            ->orderBy('table_number')
            ->get();

        return view('reservations.create', compact('tables'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'number_of_guests' => 'required|integer|min:1',
            'reservation_date' => 'required|date|after:now',
            'table_id' => 'required|exists:tables,id',
            'special_requests' => 'nullable|string'
        ]);

        // Check if table is available
        $table = Table::findOrFail($validated['table_id']);
        if (!$table->isAvailable($validated['reservation_date'])) {
            return back()->withErrors(['table_id' => 'Selected table is not available for this time.']);
        }

        // Add user_id if logged in
        if (Auth::check()) {
            $validated['user_id'] = Auth::id();
        }

        $reservation = Reservation::create($validated);

        // Update table status
        $table->update(['status' => 'reserved']);

        return redirect()->route('reservations.show', $reservation)
            ->with('success', 'Reservation created successfully! We will confirm your reservation shortly.');
    }

    public function show(Reservation $reservation)
    {
        $this->authorize('view', $reservation);
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $this->authorize('update', $reservation);

        $tables = Table::where('status', '!=', 'maintenance')
            ->orderBy('table_number')
            ->get();

        return view('reservations.edit', compact('reservation', 'tables'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $this->authorize('update', $reservation);

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'number_of_guests' => 'required|integer|min:1',
            'reservation_date' => 'required|date|after:now',
            'table_id' => 'required|exists:tables,id',
            'special_requests' => 'nullable|string'
        ]);

        // Check if table is available (if table is changed)
        if ($reservation->table_id != $validated['table_id']) {
            $table = Table::findOrFail($validated['table_id']);
            if (!$table->isAvailable($validated['reservation_date'])) {
                return back()->withErrors(['table_id' => 'Selected table is not available for this time.']);
            }

            // Update old table status
            $reservation->table->update(['status' => 'available']);

            // Update new table status
            $table->update(['status' => 'reserved']);
        }

        $reservation->update($validated);

        return redirect()->route('reservations.show', $reservation)
            ->with('success', 'Reservation updated successfully.');
    }

    public function destroy(Reservation $reservation)
    {
        $this->authorize('delete', $reservation);

        // Update table status
        $reservation->table->update(['status' => 'available']);

        $reservation->update(['status' => 'cancelled']);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation cancelled successfully.');
    }

    public function checkAvailability(Request $request)
    {
        $validated = $request->validate([
            'reservation_date' => 'required|date|after:now',
            'number_of_guests' => 'required|integer|min:1'
        ]);

        $availableTables = Table::where('status', '!=', 'maintenance')
            ->where('capacity', '>=', $validated['number_of_guests'])
            ->get()
            ->filter(function ($table) use ($validated) {
                return $table->isAvailable($validated['reservation_date']);
            });

        return response()->json([
            'available' => $availableTables->isNotEmpty(),
            'tables' => $availableTables
        ]);
    }
}
