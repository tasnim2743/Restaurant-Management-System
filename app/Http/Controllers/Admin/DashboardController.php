<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTables = Table::count();
        $pendingReservations = Reservation::where('status', 'pending')->count();
        $todayReservations = Reservation::whereDate('reservation_date', today())->count();

        return view('admin.dashboard', compact('totalTables', 'pendingReservations', 'todayReservations'));
    }
}
