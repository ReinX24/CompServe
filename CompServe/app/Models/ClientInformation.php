<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientInformation extends Model
{
    protected $fillable = [
        'user_id',
        'about_me',
        'contact_number',
        'facebook',
        'instagram',
        'linkedin',
        'twitter'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
