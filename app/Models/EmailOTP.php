<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailOTP extends Model
{
    protected $table = 'email_otps';

    protected $fillable = [
        'user_id',
        'otp',
        'verified',
        'expires_at'
    ];

    protected $casts = [
        'verified' => 'boolean',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isValid()
    {
        return !$this->verified && now()->lt($this->expires_at);
    }
}
