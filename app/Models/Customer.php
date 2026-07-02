<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company_name',
        'address',
        'notes',
        'status',
        'source',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
}
