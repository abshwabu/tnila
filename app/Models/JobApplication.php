<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;

    protected $fillable = [
        'job_listing_id',
        'applicant_name',
        'email',
        'phone',
        'resume',
        'cover_letter',
        'status',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function jobListing()
    {
        return $this->belongsTo(JobListing::class);
    }
}
