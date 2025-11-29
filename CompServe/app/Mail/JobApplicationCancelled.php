<?php

namespace App\Mail;

use App\Models\JobApplication;
use App\Models\JobListing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobApplicationCancelled extends Mailable
{
    use Queueable, SerializesModels;

    public $jobListing;
    public $application;

    public function __construct(JobListing $jobListing, JobApplication $application)
    {
        $this->jobListing = $jobListing;
        $this->application = $application;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Job Application Cancelled',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.job-application-cancelled',
        );
    }
}
