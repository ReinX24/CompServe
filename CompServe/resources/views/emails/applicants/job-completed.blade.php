@component('mail::message')

{{-- Logo --}}
<div style="text-align:center; margin-bottom: 20px;">
    <img src="cid:logo"
         alt="CompServe Logo"
         style="height: 90px; object-fit: contain; border-radius: 50%;">
</div>

# 🎉 Job Completed

Hello **{{ $application->freelancer->name }}**,

Your work for the job **"{{ $jobListing->title }}"** has been marked as **completed** by the client **{{ $jobListing->client->name }}**.

Thank you for your hard work and professionalism!

---

### ⭐ Client Rating
@if($jobListing->review)
@component('mail::panel')
**Rating:** {{ $jobListing->review->rating }} / 5
**Comments:**
{{ $jobListing->review->comments }}
@endcomponent
@else
The client has not provided a rating or review.
@endif

---

If you have any concerns about this job, feel free to reach out through the platform.

@component('mail::subcopy')
CompServe © {{ date('Y') }}
This is an automated email — please do not reply.
@endcomponent

@endcomponent
