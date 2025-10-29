<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'price_paid',
        'status',
        'midtrans_order_id',
        'midtrans_status',
    ];

    protected $casts = [
        'price_paid' => 'decimal:2',
    ];

    // Relasi: Ticket milik Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relasi: Ticket milik User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
