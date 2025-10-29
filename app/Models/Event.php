<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'talent_id',
        'title',
        'description',
        'type',
        'start_date',
        'end_date',
        'location',
        'quota',
        'price',
        'thumbnail', // Tambahan untuk thumbnail
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'price' => 'decimal:2',
        'quota' => 'integer',
    ];

    // Accessor untuk format price ke Rupiah (perbaiki: konversi Decimal ke float)
    public function getPriceFormattedAttribute()
    {
        if (is_null($this->price)) {
            return 'Rp 0';
        }
        $priceFloat = (float) $this->price; // Konversi Decimal ke float
        return 'Rp ' . number_format($priceFloat, 0, ',', '.');
    }

    // Relasi: Event dimiliki oleh Talent (User)
    public function talent()
    {
        return $this->belongsTo(User::class, 'talent_id');
    }

    // Relasi: Event punya banyak Ticket
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Get remaining quota for the event
     */
    public function getRemainingQuotaAttribute()
    {
        $soldTickets = $this->tickets()
            ->where('status', 'purchased')
            ->count();

        return max(0, $this->quota - $soldTickets);
    }

    /**
     * Get sold tickets count
     */
    public function getSoldTicketsAttribute()
    {
        return $this->tickets()
            ->where('status', 'purchased')
            ->count();
    }

    /**
     * Check if event has available quota
     */
    public function getHasAvailableQuotaAttribute()
    {
        return $this->remaining_quota > 0;
    }
}
