@props(['title' => 'Notification', 'emoji' => '📩'])

<div
    style="
    display:inline-block;
    background:#3b82f6;
    color:white;
    padding:6px 14px;
    border-radius:12px;
    font-size:12px;
    font-weight:bold;
    margin-bottom:16px;
">
    {{ $emoji }} {{ $title }}
</div>

<div>
    {{ $slot }}
</div>
