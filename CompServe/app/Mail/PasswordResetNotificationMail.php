<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $newPassword;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $newPassword)
    {
        $this->user = $user;
        $this->newPassword = $newPassword;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your Password Has Been Reset')
            ->markdown('emails.password_reset')
            ->withSymfonyMessage(function ($message) {
                $message->embedFromPath(
                    public_path('images/logo.png'),
                    'logo'
                );
            });
    }
}
