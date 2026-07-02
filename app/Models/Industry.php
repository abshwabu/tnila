<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Industry extends Model
{
    use HasFactory;
    use HasSlug;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
