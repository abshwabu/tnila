<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        $this->addMediaConversion('preview')
            ->width(1600)
            ->height(1200)
            ->sharpen(10);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function featuredImageUrl(): string
    {
        return $this->getFirstMediaUrl('images', 'preview')
            ?: $this->getFirstMediaUrl('images')
            ?: asset('images/project-placeholder.svg');
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
