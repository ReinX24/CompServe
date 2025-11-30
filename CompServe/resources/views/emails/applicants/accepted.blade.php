@component('mail::message')

{{-- LOGO --}}
<div style="text-align:center; margin-bottom: 20px;">
    <img src="{{ asset('images/logo.png') }}" alt="CompServe Logo" style="height: 90px; border-radius: 50%;">
</div>

# 🎉 Congratulations, {{ $application->freelancer->name }}!

Your application for the job:

**{{ $application->job->title }}**

has been **accepted** by the client.

@component('mail::button', ['url' => route('freelancer.jobs.show', $application->job_id)])
View Job Details
@endcomponent

We look forward to your amazing work!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
