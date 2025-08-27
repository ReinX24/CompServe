<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreelancerInformation extends Model
{
    protected $fillable = [
        'user_id',
        'contact_number',
        'about_me'
    ];

    // TODO: add skills
    // TODO: add experience
    // TODO: add education
    // TODO: add certifications (TO BE VERIFIED BY ADMIN)

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
