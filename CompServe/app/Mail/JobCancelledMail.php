<?php

namespace App\Mail;

use App\Models\JobApplication;
use App\Models\JobListing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobCancelledMail extends Mailable
{
    use Queueable, SerializesModels;

    public $jobListing;
    public $application;

    /**
     * Create a new message instance.
     */
    public function __construct(JobListing $jobListing, JobApplication $jobApplication)
    {
        $this->jobListing = $jobListing;
        $this->jobApplication = $jobApplication;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('⚠ Job Cancelled: ' .
            $this->jobListing->title)
            ->markdown('emails.applicants.job-cancelled')
            ->withSymfonyMessage(function ($message) {
                $message->embedFromPath(
                    public_path('images/logo.png'),
                    'logo'
                );
            });
    }
}
