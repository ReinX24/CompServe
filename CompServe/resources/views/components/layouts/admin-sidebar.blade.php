<x-layouts.sidebar-link href="{{ route('admin.dashboard') }}"
    icon='fas-house'
    :active="request()->routeIs('admin.dashboard')">
    Dashboard
</x-layouts.sidebar-link>

<x-layouts.sidebar-link href="{{ route('admin.users') }}"
    icon='fas-user'
    :active="request()->routeIs('admin.users')">
    Users
</x-layouts.sidebar-link>

<x-layouts.sidebar-link href="{{ route('admin.jobs') }}"
    icon='fas-briefcase'
    :active="request()->routeIs('admin.jobs')">
    Jobs
</x-layouts.sidebar-link>

<x-layouts.sidebar-link href="{{ route('admin.reviews') }}"
    icon='fas-star'
    :active="request()->routeIs('admin.reviews')">
    Reviews
</x-layouts.sidebar-link>
