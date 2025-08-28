<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FreelancerInformation extends Model
{
    protected $fillable = [
        'contact_number',
        'about_me',
        'skills',
        'experiences'
    ];

    protected $casts = [
        'skills' => 'array',
        'experiences' => 'array'
    ];

    // DONE: add skills
    // DONE: add experience
    // TODO: add education
    // TODO: add certifications (TO BE VERIFIED BY ADMIN)

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
