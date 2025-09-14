<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'title',
        'description',
        'category',
        'skills_required',
        'budget_type',
        'budget',
        'location',
        'deadline',
        'status',
    ];

    protected $casts = [
        'skills_required' => 'array',
        'deadline' => 'date',
    ];

    // Relationships
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    // TODO: add JobApplications
    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }
}
