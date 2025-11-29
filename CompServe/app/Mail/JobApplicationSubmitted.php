<?php

namespace App\Mail;

use App\Models\JobApplication;
use App\Models\JobListing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobApplicationSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $jobListing;
    public $application;

    /**
     * Create a new message instance.
     */
    public function __construct(JobListing $jobListing, JobApplication $application)
    {
        $this->jobListing = $jobListing;
        $this->application = $application;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Job Application Submitted',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.job-application-submitted',
            with: [
                'jobListing' => $this->jobListing,
                'application' => $this->application,
            ],
        );
    }
}
