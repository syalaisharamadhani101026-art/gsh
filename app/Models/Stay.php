<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stay extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id',
        'transaction_type', // 'room' or 'banquet'
        'booking_code',
        'room_type',
        'points_per_night',
        'nights',
        'revenue_amount',
        'points_earned',
        'points_added',
        'stay_date',
        'notes',
    ];

    protected $casts = [
        'stay_date' => 'date',
        'nights' => 'integer',
        'points_per_night' => 'integer',
        'revenue_amount' => 'integer',
        'points_earned' => 'integer',
        'points_added' => 'integer',
    ];

    /**
     * Relasi ke tamu
     */
    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }
}
