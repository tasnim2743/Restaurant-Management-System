<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'table_id',
        'customer_name',
        'email',
        'phone',
        'number_of_guests',
        'reservation_date',
        'status',
        'special_requests'
    ];

    protected $casts = [
        'reservation_date' => 'datetime',
        'number_of_guests' => 'integer',
    ];

    // Relationship with user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with table
    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    // Scope for upcoming reservations
    public function scopeUpcoming($query)
    {
        return $query->where('reservation_date', '>=', now())
            ->where('status', '!=', 'cancelled');
    }

    // Scope for today's reservations
    public function scopeToday($query)
    {
        return $query->whereDate('reservation_date', today())
            ->where('status', '!=', 'cancelled');
    }
}
