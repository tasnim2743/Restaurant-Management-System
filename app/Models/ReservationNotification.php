<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReservationNotification extends Model
{
    protected $fillable = [
        'user_id',
        'reservation_id',
        'title',
        'message',
        'type',
        'read'
    ];

    protected $casts = [
        'read' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function markAsRead(): void
    {
        $this->update(['read' => true]);
    }
}
