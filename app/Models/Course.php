<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'talent_id',
        'name',
        'description',
        'quota',
        'price',
        'thumbnail',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quota' => 'integer',
    ];

    // Accessor untuk format price ke Rupiah
    public function getPriceFormattedAttribute()
    {
        if (is_null($this->price)) {
            return 'Rp 0';
        }
        $priceFloat = (float) $this->price;
        return 'Rp ' . number_format($priceFloat, 0, ',', '.');
    }

    // Relasi: Course dimiliki oleh Talent (User)
    public function talent()
    {
        return $this->belongsTo(User::class, 'talent_id');
    }

    // Relasi: Course punya banyak Registration
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Get remaining quota for the course
     */
    public function getRemainingQuotaAttribute()
    {
        $soldRegistrations = $this->registrations()
            ->where('status', 'purchased')
            ->count();

        return max(0, $this->quota - $soldRegistrations);
    }

    /**
     * Get sold registrations count
     */
    public function getSoldRegistrationsAttribute()
    {
        return $this->registrations()
            ->where('status', 'purchased')
            ->count();
    }

    /**
     * Check if course has available quota
     */
    public function getHasAvailableQuotaAttribute()
    {
        return $this->remaining_quota > 0;
    }

    /**
     * Get all purchased registrations
     */
    public function purchasedRegistrations()
    {
        return $this->registrations()->where('status', 'purchased');
    }

    /**
     * Get all pending registrations
     */
    public function pendingRegistrations()
    {
        return $this->registrations()->where('status', 'pending');
    }
}
