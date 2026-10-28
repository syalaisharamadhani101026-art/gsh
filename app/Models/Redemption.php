<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Redemption extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id',
        'voucher_code',
        'item_title',
        'item_category',
        'item_detail',
        'selected_option',
        'points_cost',
        'points_before',
        'points_after',
        'status',
        'redeemed_at',
        'notes',
    ];

    protected $casts = [
        'item_category' => 'integer',
        'points_cost' => 'integer',
        'points_before' => 'integer',
        'points_after' => 'integer',
        'redeemed_at' => 'datetime',
    ];

    /**
     * Relasi ke Tamu (Guest)
     */
    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    /**
     * Generate Kode Voucher Unik
     */
    public static function generateVoucherCode(): string
    {
        do {
            $code = 'GSH-RDM-' . strtoupper(Str::random(6));
        } while (self::where('voucher_code', $code)->exists());

        return $code;
    }
}
