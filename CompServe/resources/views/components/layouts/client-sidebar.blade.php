<x-layouts.sidebar-link href="{{ route('client.dashboard') }}"
    icon='fas-house'
    :active="request()->routeIs('client.dashboard')">
    Dashboard
</x-layouts.sidebar-link>

<x-layouts.sidebar-two-level-link-parent title="Jobs"
    icon='fas-pencil-alt'
    :active="request()->routeIs('client.jobs*')">
    <x-layouts.sidebar-two-level-link href="{{ route('client.jobs.index') }}"
        icon='fas-border-all'
        :active="request()->routeIs('client.jobs.index')">
        All Jobs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link href="{{ route('client.jobs.posts') }}"
        icon='far-folder-open'
        :active="request()->routeIs('client.jobs.posts')">
        Posted Jobs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('client.jobs.in_progress') }}"
        icon='fas-envelope-open-text'
        :active="request()->routeIs('client.jobs.in_progress')">
        In Progress Jobs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('client.jobs.cancelled') }}"
        icon='far-circle-xmark'
        :active="request()->routeIs('client.jobs.cancelled')">
        Cancelled Jobs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('client.jobs.completed') }}"
        icon='fas-pen'
        :active="request()->routeIs('client.jobs.completed')">
        Completed Jobs
    </x-layouts.sidebar-two-level-link>
</x-layouts.sidebar-two-level-link-parent>

<x-layouts.sidebar-two-level-link-parent title="Jobs"
    icon='fas-pencil-alt'
    :active="request()->routeIs('client.jobs*')">
    <x-layouts.sidebar-two-level-link href="{{ route('client.jobs.index') }}"
        icon='fas-border-all'
        :active="request()->routeIs('client.jobs.index')">
        All Gigs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link href="{{ route('client.jobs.posts') }}"
        icon='far-folder-open'
        :active="request()->routeIs('client.jobs.posts')">
        Posted Jobs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('client.jobs.in_progress') }}"
        icon='fas-envelope-open-text'
        :active="request()->routeIs('client.jobs.in_progress')">
        In Progress Jobs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('client.jobs.cancelled') }}"
        icon='far-circle-xmark'
        :active="request()->routeIs('client.jobs.cancelled')">
        Cancelled Jobs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('client.jobs.completed') }}"
        icon='fas-pen'
        :active="request()->routeIs('client.jobs.completed')">
        Completed Jobs
    </x-layouts.sidebar-two-level-link>
</x-layouts.sidebar-two-level-link-parent>

<x-layouts.sidebar-two-level-link-parent title="Jobs"
    icon='fas-pen-alt'
    :active="request()->routeIs('client.jobs*')">
    <x-layouts.sidebar-two-level-link href="{{ route('client.jobs.index') }}"
        icon='fas-border-all'
        :active="request()->routeIs('client.jobs.index')">
        All Contracts
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link href="{{ route('client.jobs.posts') }}"
        icon='far-folder-open'
        :active="request()->routeIs('client.jobs.posts')">
        Posted Jobs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('client.jobs.in_progress') }}"
        icon='fas-envelope-open-text'
        :active="request()->routeIs('client.jobs.in_progress')">
        In Progress Jobs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('client.jobs.cancelled') }}"
        icon='far-circle-xmark'
        :active="request()->routeIs('client.jobs.cancelled')">
        Cancelled Jobs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('client.jobs.completed') }}"
        icon='fas-pen'
        :active="request()->routeIs('client.jobs.completed')">
        Completed Jobs
    </x-layouts.sidebar-two-level-link>
</x-layouts.sidebar-two-level-link-parent>

<x-layouts.sidebar-link href="{{ route('client.reviews') }}"
    icon='fas-star'
    :active="request()->routeIs('client.reviews')">
    Reviews
</x-layouts.sidebar-link>

<x-layouts.sidebar-link href="{{ route('client.profile.show') }}"
    icon='fas-person'
    :active="request()->routeIs('client.profile.show')">
    Profile
</x-layouts.sidebar-link>
