<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'user_id',
        'whatsapp_number',
        'price_paid',
        'status',
        'midtrans_order_id',
        'midtrans_status',
    ];

    protected $casts = [
        'price_paid' => 'decimal:2',
    ];

    // Relasi: Registration milik Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relasi: Registration milik User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if registration is pending
     */
    public function getIsPendingAttribute()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if registration is purchased
     */
    public function getIsPurchasedAttribute()
    {
        return $this->status === 'purchased';
    }

    /**
     * Check if registration is cancelled
     */
    public function getIsCancelledAttribute()
    {
        return $this->status === 'cancelled';
    }

    /**
     * Format price paid to Rupiah
     */
    public function getPricePaidFormattedAttribute()
    {
        if (is_null($this->price_paid)) {
            return 'Rp 0';
        }
        $priceFloat = (float) $this->price_paid;
        return 'Rp ' . number_format($priceFloat, 0, ',', '.');
    }
}
