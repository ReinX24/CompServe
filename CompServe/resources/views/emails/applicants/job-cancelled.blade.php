@component('mail::message')

{{-- Logo --}}
<div style="text-align:center; margin-bottom: 20px;">
    <img src="cid:logo"
         alt="CompServe Logo"
         style="height: 90px; object-fit: contain; border-radius: 50%;">
</div>

# ⚠️ Job Cancelled

Hello **{{ $application->freelancer->name ?? 'Freelancer' }}**,

The job **{{ $jobListing->title }}** has been cancelled by the client.

@if($jobListing->review)
### ⭐ Client Review
@component('mail::panel')
**Rating:** {{ $jobListing->review->rating }} / 5
**Comments:** {{ $jobListing->review->comments }}
@endcomponent
@else
The client did not provide a review.
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
