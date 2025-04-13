<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::with(['reservation.table'])
            ->latest()
            ->paginate(10);

        return view('admin.bills.index', compact('bills'));
    }

    public function show(Bill $bill)
    {
        $bill->load('reservation.table');
        return view('admin.bills.show', compact('bill'));
    }

    public function generate(Reservation $reservation)
    {
        // Check if bill already exists
        if ($reservation->bill) {
            return redirect()->route('admin.bills.show', $reservation->bill)
                ->with('info', 'Bill already exists for this reservation.');
        }

        // Calculate bill amount based on table and duration
        $hours = $reservation->created_at->diffInHours($reservation->reservation_date) + 1;
        $tableRate = 10.00; // Base rate per hour
        $subtotal = $hours * $tableRate;

        // Create new bill
        $bill = Bill::create([
            'reservation_id' => $reservation->id,
            'subtotal' => $subtotal,
            'tax' => $subtotal * 0.1, // 10% tax
            'total' => $subtotal * 1.1,
            'payment_status' => 'pending'
        ]);

        // If request comes from customer notification, redirect to show page
        if (!Auth::user()->is_admin) {
            return redirect()->route('bills.show', $bill)
                ->with('success', 'Your bill has been generated. Please proceed with payment.');
        }

        return redirect()->route('admin.bills.show', $bill)
            ->with('success', 'Bill generated successfully.');
    }

    public function processPayment(Request $request, Bill $bill)
    {
        if ($bill->payment_status === 'paid') {
            return back()->with('error', 'This bill has already been paid.');
        }

        try {
            $bill->markAsPaid(
                $request->input('payment_method', 'cash'),
                $request->input('payment_reference')
            );

            return redirect()->route('bills.show', $bill)
                ->with('success', 'Payment processed successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function downloadPdf(Bill $bill)
    {
        $bill->load('reservation.table');

        $pdf = Pdf::loadView('admin.bills.pdf', compact('bill'));

        return $pdf->download('bill-' . $bill->id . '.pdf');
    }
}
