<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientProfile extends Model
{
    protected $fillable = [
        'user_id',
        'company_name',
        'contact_number',
        'website',
        'bio',
        'location',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
