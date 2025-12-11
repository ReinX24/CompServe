@props(['title' => 'Notification', 'emoji' => '📩'])

<div
    class="inline-flex items-center gap-2 bg-blue-500 text-white px-4 py-2 rounded-xl text-sm font-bold mb-4 shadow-sm">
    <span class="text-base">{{ $emoji }}</span>
    <span>{{ $title }}</span>
</div>
