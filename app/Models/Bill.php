<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Bill extends Model
{
    protected $fillable = [
        'reservation_id',
        'subtotal',
        'tax',
        'total',
        'payment_status',
        'payment_method',
        'payment_reference'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function calculateTotals(): void
    {
        $this->subtotal = $this->reservation->total_amount;
        $this->tax = $this->subtotal * 0.1; // 10% tax
        $this->total = $this->subtotal + $this->tax;
        $this->save();
    }

    public function markAsPaid(string $method, ?string $reference = null): void
    {
        if ($this->payment_status === 'paid') {
            throw new \Exception('Bill has already been paid.');
        }

        DB::beginTransaction();
        try {
            // Update bill payment status
            $this->payment_status = 'paid';
            $this->payment_method = $method;
            $this->payment_reference = $reference;
            $this->save();

            // Update reservation status if exists
            if ($this->reservation) {
                DB::table('reservations')
                    ->where('id', $this->reservation_id)
                    ->update(['status' => 'completed']);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
