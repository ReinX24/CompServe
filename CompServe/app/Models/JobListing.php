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

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }

    public function scopeFilter($query, $filters)
    {
        return $query
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($filters['category'] ?? null, function ($query, $category) {
                $query->where('category', $category);
            })
            ->when($filters['client'] ?? null, function ($query, $client) {
                $query->whereHas('client', fn($q) => $q->where('name', 'like', "%{$client}%"));
            })
            ->when($filters['location'] ?? null, function ($query, $location) {
                $query->where('location', 'like', "%{$location}%");
            });
    }
}
