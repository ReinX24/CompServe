@component('mail::message')

{{-- LOGO --}}
<div style="text-align:center; margin-bottom: 20px;">
    <img src="{{ asset('images/logo.png') }}"
         alt="CompServe Logo"
         style="height: 90px; border-radius: 50%;">
</div>

# ❌ Application Update: Not Selected

Hello **{{ $application->freelancer->name }}**,

Thank you for applying to the position:

**{{ $application->job->title }}**

After careful review, we regret to inform you that you were not selected for this opportunity.

We appreciate your time and effort in submitting your application and encourage you to continue applying to other listings.

---

@component('mail::subcopy')
CompServe © {{ date('Y') }}
This is an automated email — please do not reply.
@endcomponent

@endcomponent
