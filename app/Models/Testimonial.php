<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'customer_id',
        'author_name',
        'author_role',
        'company',
        'content',
        'rating',
        'project_id',
        'featured',
        'approved',
    ];

    protected $casts = [
        'rating' => 'integer',
        'featured' => 'boolean',
        'approved' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
