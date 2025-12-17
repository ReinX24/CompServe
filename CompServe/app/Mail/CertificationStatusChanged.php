<?php

namespace App\Mail;

use App\Models\Certification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Mime\Email;

class CertificationStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $certification;
    public $status;

    public function __construct(Certification $certification, $status)
    {
        $this->certification = $certification;
        $this->status = $status;
    }

    public function build()
    {
        return $this->subject('Your Certification Status Has Been Updated')
            ->markdown('emails.certification-status')
            ->withSymfonyMessage(function ($message) {
                $message->embedFromPath(
                    public_path('images/logo.png'),
                    'logo'
                );
            });
    }
}
