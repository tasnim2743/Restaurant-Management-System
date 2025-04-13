<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;
use App\Models\ReservationNotification;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['table', 'user'])
            ->latest()
            ->paginate(10);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['table', 'user']);
        return view('admin.reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $tables = Table::all();
        return view('admin.reservations.edit', compact('reservation', 'tables'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'table_id' => 'sometimes|exists:tables,id',
            'special_requests' => 'nullable|string'
        ]);

        $oldStatus = $reservation->status;
        $reservation->update($validated);

        // Create notification based on status change
        if ($oldStatus !== $validated['status'] && $reservation->user_id) {
            $notificationData = [
                'user_id' => $reservation->user_id,
                'reservation_id' => $reservation->id,
            ];

            switch ($validated['status']) {
                case 'confirmed':
                    $notificationData['title'] = 'Reservation Confirmed';
                    $notificationData['message'] = "Your reservation for {$reservation->number_of_guests} guests on " .
                        $reservation->reservation_date->format('F j, Y \a\t g:i A') . " has been confirmed.";
                    $notificationData['type'] = 'success';
                    break;
                case 'cancelled':
                    $notificationData['title'] = 'Reservation Cancelled';
                    $notificationData['message'] = "Your reservation for {$reservation->number_of_guests} guests on " .
                        $reservation->reservation_date->format('F j, Y \a\t g:i A') . " has been cancelled.";
                    $notificationData['type'] = 'error';
                    break;
                case 'completed':
                    $notificationData['title'] = 'Reservation Completed';
                    $notificationData['message'] = "Thank you for dining with us! We hope you enjoyed your experience.";
                    $notificationData['type'] = 'info';
                    break;
            }

            if (isset($notificationData['title'])) {
                ReservationNotification::create($notificationData);
            }
        }

        // Update table status if reservation is confirmed
        if ($validated['status'] === 'confirmed') {
            $reservation->table->update(['status' => 'reserved']);
        }

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservation updated successfully');
    }

    public function destroy(Reservation $reservation)
    {
        // Update table status
        $reservation->table->update(['status' => 'available']);

        // Cancel the reservation
        $reservation->update(['status' => 'cancelled']);

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservation cancelled successfully');
    }

    public function calendar()
    {
        $reservations = Reservation::with(['table'])
            ->where('status', '!=', 'cancelled')
            ->get();

        return view('admin.reservations.calendar', compact('reservations'));
    }

    public function confirm(Reservation $reservation)
    {
        $reservation->update(['status' => 'confirmed']);
        
        // Create notification for the user
        ReservationNotification::create([
            'user_id' => $reservation->user_id,
            'reservation_id' => $reservation->id,
            'title' => 'Reservation Confirmed',
            'message' => "Your reservation for {$reservation->reservation_date->format('M d, Y h:i A')} has been confirmed.",
            'type' => 'success'
        ]);

        return back()->with('success', 'Reservation confirmed successfully');
    }

    public function cancel(Reservation $reservation)
    {
        $reservation->update(['status' => 'cancelled']);
        return back()->with('success', 'Reservation cancelled successfully');
    }

    public function showAssignTable(Reservation $reservation)
    {
        $availableTables = Table::where('is_available', true)
            ->whereDoesntHave('reservations', function ($query) use ($reservation) {
                $query->where('reservation_time', $reservation->reservation_time)
                    ->where('status', 'confirmed')
                    ->where('id', '!=', $reservation->id);
            })
            ->orderBy('capacity')
            ->get();

        return view('admin.reservations.assign-table', compact('reservation', 'availableTables'));
    }

    public function assignTable(Request $request, Reservation $reservation)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id'
        ]);

        $table = Table::findOrFail($request->table_id);

        // Check if table has enough capacity
        if ($table->capacity < $reservation->number_of_guests) {
            return back()->with('error', 'Selected table does not have enough capacity');
        }

        // Check if table is available at the requested time
        $isTableAvailable = !$table->reservations()
            ->where('reservation_time', $reservation->reservation_time)
            ->where('status', 'confirmed')
            ->where('id', '!=', $reservation->id)
            ->exists();

        if (!$isTableAvailable) {
            return back()->with('error', 'Table is not available at the requested time');
        }

        $reservation->update([
            'table_id' => $table->id,
            'status' => 'confirmed'
        ]);

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Table assigned successfully');
    }
}
