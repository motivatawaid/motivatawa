<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'talent_id',
        'title',
        'description',
        'video_path', // Path file video (lokal)
        'price',
        'thumbnail',
    ];

    protected $casts = [
        'price' => 'decimal:2',
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

    // Relasi: Video dimiliki oleh Talent (User)
    public function talent()
    {
        return $this->belongsTo(User::class, 'talent_id');
    }

    // Relasi: Video punya banyak Purchase
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
