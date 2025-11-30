@component('mail::message')

{{-- LOGO --}}
<div style="text-align:center; margin-bottom: 20px;">
    <img src="{{ asset('images/logo.png') }}" alt="CompServe Logo" style="height: 90px; border-radius: 50%;">
</div>

# 🔐 Password Reset Notification

Hello **{{ $user->name }}** 👋

Your password has been reset by an administrator.

---

### Your New Temporary Password
@component('mail::panel')
**{{ $newPassword }}**
@endcomponent

Please log in and change your password immediately for security purposes.

---

@component('mail::subcopy')
CompServe © {{ date('Y') }}
This is an automated email — please do not reply.
@endcomponent

@endcomponent
