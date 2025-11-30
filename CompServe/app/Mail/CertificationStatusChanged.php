<?php

namespace App\Mail;

use App\Models\Certification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

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

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Certification Status Has Been Updated'
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.certification-status'
        );
    }
}
