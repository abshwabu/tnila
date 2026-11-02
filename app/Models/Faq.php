<?php

namespace App\Models;

use App\Models\Concerns\FlushesSiteCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use FlushesSiteCache;
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'question',
        'answer',
        'category',
        'order',
    ];
}
