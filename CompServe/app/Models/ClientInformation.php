<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientInformation extends Model
{
    /** @use HasFactory<\Database\Factories\ClientInformationFactory> */
    use HasFactory;
    protected $table = 'client_information';

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'user_id',
        'company_name',
        'contact_person',
        'contact_number',
        'website',
        'country',
        'city',
        'address',
        'about_us',
        'industry',
        'company_size',
        'social_links',
    ];

    /**
     * Cast attributes to specific types.
     */
    protected $casts = [
        'social_links' => 'array',   // JSON automatically becomes array
    ];

    /**
     * A client information belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
