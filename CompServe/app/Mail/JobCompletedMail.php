<?php

namespace App\Mail;

use App\Models\JobListing;
use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobCompletedMail extends Mailable
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
     * Build the message.
     */
    public function build()
    {
        return $this->subject('🎉 Job Completed: ' . $this->jobListing->title)
            ->markdown('emails.applicants.job-completed');
    }
}
