<?php

namespace App\Models;

use App\Models\Concerns\FlushesSiteCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Service extends Model
{
    use FlushesSiteCache;
    use HasFactory;
    use HasSlug;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'icon',
        'featured',
        'order',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'order' => 'integer',
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
}
