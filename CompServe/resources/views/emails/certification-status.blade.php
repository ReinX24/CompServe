@component('mail::message')

{{-- LOGO --}}
<div style="text-align:center; margin-bottom: 20px;">
    <img src="cid:logo"
         alt="CompServe Logo"
         style="height: 100px; border-radius: 50%;">
</div>

{{-- TITLE BADGE --}}
<div style="
    display:inline-block;
    background:#3b82f6;
    color:white;
    padding:8px 16px;
    border-radius:9999px;
    font-weight:bold;
    font-size:14px;
    margin-bottom:20px;
    box-shadow:0 2px 6px rgba(59,130,246,.3);
">
📄 Certification Status Update
</div>

Hello **{{ $certification->freelancer->name }}** 👋
Your certification request has been reviewed.

---

{{-- ICON for Certification Type --}}
@php
    $typeIcons = [
        'NC I' => '🟢',
        'NC II' => '🔵',
        'NC III' => '🟡',
        'NC IV' => '🟠',
        'Tech Certification' => '💻',
    ];
    $icon = $typeIcons[$certification->type] ?? '📄';
@endphp

**Certification Type:** {{ $icon }} {{ $certification->type }}

---

{{-- STATUS BOX (Markdown Panel Trick) --}}
@php
    $statusColors = [
        'approved' => 'background:#d1fae5; color:#065f46; border:1px solid #10b981;',
        'pending'  => 'background:#fef9c3; color:#92400e; border:1px solid #f59e0b;',
        'rejected' => 'background:#fee2e2; color:#991b1b; border:1px solid #ef4444;',
    ];
@endphp

<div style="padding:12px; border-radius:8px; text-align:center; font-weight:bold; margin: 15px 0; {{ $statusColors[(string)$status] ?? '' }}">
    {{ ucfirst($status) }}
</div>

---

{{-- STATUS MESSAGES --}}
@if ($status === 'approved')
🎉 **Congratulations! Your certification has been approved.**

You may now enjoy the benefits associated with your certification.

@elseif ($status === 'pending')
⏳ **Your certification is still under review.**

We will notify you once a decision has been made.

@else
❌ **Unfortunately, your certification has been rejected.**

@if (!empty($reason))
### Reason for Rejection:
<div style="background:#fee2e2; padding:10px; border-radius:8px; border:1px solid #ef4444; color:#991b1b;">
{{ $reason }}
</div>
@endif

If you believe this is a mistake, you may resubmit or contact support.
@endif

---

{{-- VIEW DOCUMENT BUTTON --}}
@component('mail::button', ['url' => Storage::url($certification->document_path)])
🔍 View Certification
@endcomponent

---

@component('mail::subcopy')
CompServe © {{ date('Y') }}
Automated email — please do not reply.
@endcomponent

@endcomponent
