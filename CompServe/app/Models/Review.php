<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'freelancer_id',
        'client_id',
        'job_listing_id',
        'rating'
    ];

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function jobListing()
    {
        return $this->belongsTo(JobListing::class, 'job_listing_id');
    }
}
