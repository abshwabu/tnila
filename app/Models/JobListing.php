<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class JobListing extends Model
{
    use HasFactory;
    use HasSlug;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'slug',
        'department',
        'location',
        'employment_type',
        'description',
        'requirements',
        'status',
    ];

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

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
