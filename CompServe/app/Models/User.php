<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn(string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    public function freelancerInformation(): HasOne
    {
        return $this->hasOne(FreelancerInformation::class);
    }

    public function clientProfile()
    {
        return $this->hasOne(ClientInformation::class);
    }

    // Posted job listings for clients
    public function jobListings()
    {
        return $this->hasMany(JobListing::class, 'client_id');
    }

    // If the user is a freelancer
    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'freelancer_id');
    }

    public function certifications()
    {
        return $this->hasMany(Certification::class, 'freelancer_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'from_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'to_id');
    }

    // Conversations helper
    public function conversations()
    {
        $sentTo = Message::where('from_id', $this->id)->pluck('to_id');
        $receivedFrom = Message::where('to_id', $this->id)->pluck('from_id');

        $userIds = $sentTo->merge($receivedFrom)->unique();

        return User::whereIn('id', $userIds)->get();
    }

    public function receivedReviews()
    {
        return $this->hasMany(Review::class, 'freelancer_id');
    }
}
