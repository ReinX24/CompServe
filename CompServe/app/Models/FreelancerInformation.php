<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FreelancerInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_number',
        'about_me',
        'skills',
        'experiences',
        'education',
        'facebook',
        'instagram',
        'linkedin',
        'twitter'
    ];

    protected $casts = [
        'skills' => 'array',
        'experiences' => 'array',
        'education' => 'array'
    ];

    // DONE: add skills
    // DONE: add experience
    // DONE: add education
    // TODO: add certifications (TO BE VERIFIED BY ADMIN)

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
