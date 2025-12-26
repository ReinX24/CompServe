<x-layouts.sidebar-link href="{{ route('client.dashboard') }}"
    icon='fas-house'
    :active="request()->routeIs('client.dashboard')">
    Dashboard
</x-layouts.sidebar-link>

{{-- <x-layouts.sidebar-two-level-link-parent title="Jobs"
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
</x-layouts.sidebar-two-level-link-parent> --}}

<x-layouts.sidebar-two-level-link-parent title="Gigs"
    icon='fas-pencil-alt'
    :active="request()->routeIs('client.gigs*')">
    <x-layouts.sidebar-two-level-link href="{{ route('client.gigs.index') }}"
        icon='fas-border-all'
        :active="request()->routeIs('client.gigs.index')">
        All Gigs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link href="{{ route('client.gigs.open') }}"
        icon='far-folder-open'
        :active="request()->routeIs('client.gigs.open')">
        Open Gigs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('client.gigs.in_progress') }}"
        icon='fas-envelope-open-text'
        :active="request()->routeIs('client.gigs.in_progress')">
        In Progress Jobs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('client.gigs.cancelled') }}"
        icon='far-circle-xmark'
        :active="request()->routeIs('client.gigs.cancelled')">
        Cancelled Gigs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('client.gigs.completed') }}"
        icon='fas-pencil'
        :active="request()->routeIs('client.gigs.completed')">
        Completed Gigs
    </x-layouts.sidebar-two-level-link>
</x-layouts.sidebar-two-level-link-parent>

<x-layouts.sidebar-two-level-link-parent title="Contracts"
    icon='fas-pen-alt'
    :active="request()->routeIs('client.contracts*')">
    <x-layouts.sidebar-two-level-link
        href="{{ route('client.contracts.index') }}"
        icon='fas-border-all'
        :active="request()->routeIs('client.contracts.index')">
        All Contracts
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('client.contracts.open') }}"
        icon='far-folder-open'
        :active="request()->routeIs('client.contracts.open')">
        Open Contracts
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('client.contracts.in_progress') }}"
        icon='fas-envelope-open-text'
        :active="request()->routeIs('client.contracts.in_progress')">
        In Progress Contracts
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('client.contracts.cancelled') }}"
        icon='far-circle-xmark'
        :active="request()->routeIs('client.contracts.cancelled')">
        Cancelled Contracts
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('client.contracts.completed') }}"
        icon='fas-pen'
        :active="request()->routeIs('client.contracts.completed')">
        Completed Contracts
    </x-layouts.sidebar-two-level-link>
</x-layouts.sidebar-two-level-link-parent>

<x-layouts.sidebar-link href="{{ route('client.reviews') }}"
    icon='fas-star'
    :active="request()->routeIs('client.reviews')">
    Reviews
</x-layouts.sidebar-link>

<x-layouts.sidebar-link href="{{ route('chat.dashboard') }}"
    icon='fas-comment-alt'
    :active="request()->routeIs('chat.dashboard')">
    Chat
</x-layouts.sidebar-link>

<x-layouts.sidebar-link href="{{ route('client.profile.show') }}"
    icon='fas-person'
    :active="request()->routeIs('client.profile.show')">
    Profile
</x-layouts.sidebar-link>

<x-layouts.sidebar-link href="{{ route('chatbot.index') }}"
    icon='fas-robot'
    :active="request()->routeIs('chatbot.index')">
    CompBot AI
</x-layouts.sidebar-link>
