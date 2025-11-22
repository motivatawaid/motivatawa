<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'title',
        'slug',
        'article',
        'thumbnail',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Boot method to auto-generate unique slug with hash
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            $news->slug = static::generateUniqueSlug($news->title);
        });

        static::updating(function ($news) {
            if ($news->isDirty('title')) {
                $news->slug = static::generateUniqueSlug($news->title);
            }
        });
    }

    /**
     * Generate a unique slug with appended hash
     */
    protected static function generateUniqueSlug($title)
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug . '-' . Str::random(8);

        // Ensure uniqueness by checking and appending counter if needed
        $originalSlug = $slug;
        $counter = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter . '-' . Str::random(4);
            $counter++;
        }

        return $slug;
    }

    // Accessor untuk excerpt dari article
    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->article), 150);
    }

    // Accessor untuk formatted published date
    public function getPublishedDateFormattedAttribute()
    {
        return $this->published_at ? $this->published_at->format('d M Y') : 'Belum Dipublikasikan';
    }

    // Relasi: News dibuat oleh Author (User)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
