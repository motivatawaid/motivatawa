<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_id',
        'user_id',
        'price_paid',
        'status',
        'midtrans_order_id',
        'midtrans_status',
    ];

    protected $casts = [
        'price_paid' => 'decimal:2',
    ];

    // Accessor untuk format price ke Rupiah
    public function getPricePaidFormattedAttribute()
    {
        if (is_null($this->price_paid)) {
            return 'Rp 0';
        }
        $priceFloat = (float) $this->price_paid;
        return 'Rp ' . number_format($priceFloat, 0, ',', '.');
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
