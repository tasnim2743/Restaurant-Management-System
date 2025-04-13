<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::orderBy('table_number')->get();
        return view('admin.tables.index', compact('tables'));
    }

    public function create()
    {
        return view('admin.tables.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_number' => 'required|string|unique:tables',
            'capacity' => 'required|integer|min:1',
            'location' => 'nullable|string',
            'description' => 'nullable|string'
        ]);

        Table::create($validated);

        return redirect()->route('admin.tables.index')
            ->with('success', 'Table created successfully.');
    }

    public function edit(Table $table)
    {
        return view('admin.tables.edit', compact('table'));
    }

    public function update(Request $request, Table $table)
    {
        $validated = $request->validate([
            'table_number' => 'required|string|unique:tables,table_number,' . $table->id,
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:available,occupied,reserved,maintenance',
            'location' => 'nullable|string',
            'description' => 'nullable|string'
        ]);

        $table->update($validated);

        return redirect()->route('admin.tables.index')
            ->with('success', 'Table updated successfully.');
    }

    public function destroy(Table $table)
    {
        if ($table->reservations()->where('status', '!=', 'cancelled')->exists()) {
            return back()->with('error', 'Cannot delete table with active reservations.');
        }

        $table->delete();

        return redirect()->route('admin.tables.index')
            ->with('success', 'Table deleted successfully.');
    }

    public function updateStatus(Request $request, Table $table)
    {
        $validated = $request->validate([
            'status' => 'required|in:available,occupied,reserved,maintenance'
        ]);

        $table->update($validated);

        return response()->json(['message' => 'Table status updated successfully.']);
    }

    public function layout()
    {
        $tables = Table::with('currentReservation')->orderBy('table_number')->get();
        return view('admin.tables.layout', compact('tables'));
    }

    public function getStatus(Request $request)
    {
        $date = $request->date ?? now()->format('Y-m-d');

        $tables = Table::with(['reservations' => function ($query) use ($date) {
            $query->whereDate('reservation_time', $date);
        }])->get();

        return response()->json($tables->map(function ($table) {
            $status = 'available';
            $statusText = 'Available';

            if (!$table->is_available) {
                $status = 'occupied';
                $statusText = 'Occupied';
            } elseif ($table->reservations->count() > 0) {
                $status = 'reserved';
                $statusText = 'Reserved: ' . $table->reservations->first()->reservation_time->format('H:i');
            }

            return [
                'id' => $table->id,
                'status' => $status,
                'statusText' => $statusText
            ];
        }));
    }

    public function getDetails(Table $table)
    {
        $table->load(['currentReservation.user']);

        return response()->json([
            'table_number' => $table->table_number,
            'capacity' => $table->capacity,
            'status' => $table->is_available ? 'Available' : 'Occupied',
            'currentReservation' => $table->currentReservation ? [
                'time' => $table->currentReservation->reservation_time->format('H:i'),
                'guest_name' => $table->currentReservation->user->name,
                'number_of_guests' => $table->currentReservation->number_of_guests
            ] : null
        ]);
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'guests' => 'required|integer|min:1'
        ]);

        $dateTime = $request->date . ' ' . $request->time;
        $guests = $request->guests;

        // Find available tables that can accommodate the party
        $availableTables = Table::where('capacity', '>=', $guests)
            ->where('is_available', true)
            ->whereDoesntHave('reservations', function ($query) use ($dateTime) {
                $query->where('reservation_time', $dateTime)
                    ->where('status', '!=', 'cancelled');
            })
            ->get();

        return response()->json([
            'available' => $availableTables->count() > 0,
            'tables' => $availableTables
        ]);
    }
}
