<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentRecord extends Model
{
    protected $fillable = [
        'job_id',
        'client_id',
        'freelancer_id',
        'price',
        'proof_of_payment',
        'status',
    ];
}
