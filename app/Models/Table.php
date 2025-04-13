<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Table extends Model
{
    protected $fillable = [
        'table_number',
        'capacity',
        'status',
        'location',
        'description'
    ];

    protected $casts = [
        'capacity' => 'integer',
    ];

    public function currentReservation()
    {
        return $this->hasOne(Reservation::class)
            ->whereDate('reservation_time', now())
            ->where('status', 'confirmed')
            ->orderBy('reservation_time');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function isAvailable($dateTime): bool
    {
        if ($this->status === 'maintenance') {
            return false;
        }

        return !$this->reservations()
            ->where('status', '!=', 'cancelled')
            ->where('reservation_date', $dateTime)
            ->exists();
    }
}
