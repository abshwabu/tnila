<?php

namespace App\Models;

use App\Models\Concerns\FlushesSiteCache;
use App\Support\Site;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BlogPost extends Model
{
    use FlushesSiteCache;
    use HasFactory;
    use HasSlug;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category',
        'author_name',
        'cover_image',
        'published_at',
        'status',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getCoverImageUrlAttribute(): string
    {
        if (filled($this->cover_image)) {
            // Check if it's already a full URL or valid storage path
            if (
                str_starts_with($this->cover_image, 'http://') ||
                str_starts_with($this->cover_image, 'https://') ||
                str_starts_with($this->cover_image, '//')
            ) {
                return $this->cover_image;
            }

            $clean = ltrim($this->cover_image, '/');
            if (file_exists(public_path($clean))) {
                return asset($clean);
            }

            if (file_exists(storage_path('app/public/' . $clean))) {
                return Site::imageUrl($clean) ?? asset('storage/' . $clean);
            }
        }

        return $this->defaultCoverImage();
    }

    public function defaultCoverImage(): string
    {
        $fallbacks = [
            'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1511818966892-d7d671e672a2?auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200&q=80',
        ];

        $idx = abs(crc32($this->slug ?: (string) $this->id)) % count($fallbacks);

        return $fallbacks[$idx];
    }
}
