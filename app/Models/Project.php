<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Project extends Model implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'customer_id',
        'industry_id',
        'description',
        'status',
        'start_date',
        'end_date',
        'location',
        'featured',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->fit(Fit::Crop, 640, 480)
            ->quality(82)
            ->withResponsiveImages()
            ->performOnCollections('images');

        $this->addMediaConversion('card')
            ->fit(Fit::Max, 1200, 900)
            ->quality(84)
            ->withResponsiveImages()
            ->performOnCollections('images');

        $this->addMediaConversion('hero')
            ->fit(Fit::Max, 1800, 1350)
            ->quality(80)
            ->withResponsiveImages()
            ->performOnCollections('images');

        $this->addMediaConversion('preview')
            ->fit(Fit::Max, 1600, 1200)
            ->quality(82)
            ->performOnCollections('images');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function featuredImageUrl(): string
    {
        if ($mediaUrl = $this->getFirstMediaUrl('images', 'card')) {
            return $mediaUrl;
        }

        if ($mediaUrl = $this->getFirstMediaUrl('images', 'preview')) {
            return $mediaUrl;
        }

        if ($mediaUrl = $this->getFirstMediaUrl('images')) {
            return $mediaUrl;
        }

        $fallbacks = [
            'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=1600&q=80',
            'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1600&q=80',
            'https://images.unsplash.com/photo-1511818966892-d7d671e672a2?auto=format&fit=crop&w=1600&q=80',
            'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1600&q=80',
        ];

        $index = abs(crc32($this->slug ?: $this->title ?: (string) $this->id)) % count($fallbacks);

        return $fallbacks[$index];
    }

    public function heroImageUrl(): string
    {
        if ($mediaUrl = $this->getFirstMediaUrl('images', 'hero')) {
            return $mediaUrl;
        }

        return $this->featuredImageUrl();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
}
