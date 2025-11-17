<x-layouts.sidebar-link href="{{ route('freelancer.dashboard') }}"
    icon='fas-house'
    :active="request()->routeIs('freelancer.dashboard')">
    Dashboard
</x-layouts.sidebar-link>

{{-- <x-layouts.sidebar-two-level-link-parent title="Jobs"
    icon='fas-pencil-alt'
    :active="request()->routeIs('freelancer.jobs*')">
    <x-layouts.sidebar-two-level-link
        href="{{ route('freelancer.jobs.available') }}"
        icon='far-folder-open'
        :active="request()->routeIs('freelancer.jobs.available')">
        Available Jobs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('freelancer.jobs.applied') }}"
        icon='fas-envelope-open-text'
        :active="request()->routeIs('freelancer.jobs.applied')">
        Applied Jobs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('freelancer.jobs.current') }}"
        icon='fas-pen'
        :active="request()->routeIs('freelancer.jobs.current')">
        Accepted Jobs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('freelancer.jobs.rejected') }}"
        icon='far-circle-xmark'
        :active="request()->routeIs('freelancer.jobs.rejected')">
        Rejected Jobs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('freelancer.jobs.finished') }}"
        icon='fas-check'
        :active="request()->routeIs('freelancer.jobs.finished')">
        Finished Jobs
    </x-layouts.sidebar-two-level-link>
</x-layouts.sidebar-two-level-link-parent> --}}

{{-- Gigs --}}
<x-layouts.sidebar-two-level-link-parent title="Gigs"
    icon='fas-pencil-alt'
    :active="request()->routeIs('freelancer.gigs*')">
    <x-layouts.sidebar-two-level-link href="{{ route('freelancer.gigs.index') }}"
        icon='fas-border-all'
        :active="request()->routeIs('freelancer.gigs.index')">
        All Gigs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link href="{{ route('freelancer.gigs.open') }}"
        icon='far-folder-open'
        :active="request()->routeIs('freelancer.gigs.open')">
        Open Gigs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('freelancer.gigs.in_progress') }}"
        icon='fas-envelope-open-text'
        :active="request()->routeIs('freelancer.gigs.in_progress')">
        In Progress Jobs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('freelancer.gigs.rejected') }}"
        icon='far-rectangle-xmark'
        :active="request()->routeIs('freelancer.gigs.rejected')">
        Rejected Gigs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('freelancer.gigs.cancelled') }}"
        icon='far-circle-xmark'
        :active="request()->routeIs('freelancer.gigs.cancelled')">
        Cancelled Gigs
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('freelancer.gigs.completed') }}"
        icon='fas-pencil'
        :active="request()->routeIs('freelancer.gigs.completed')">
        Completed Gigs
    </x-layouts.sidebar-two-level-link>
</x-layouts.sidebar-two-level-link-parent>

{{-- Contracts --}}
<x-layouts.sidebar-two-level-link-parent title="Contracts"
    icon='fas-pen-alt'
    :active="request()->routeIs('freelancer.contracts*')">
    <x-layouts.sidebar-two-level-link
        href="{{ route('freelancer.contracts.index') }}"
        icon='fas-border-all'
        :active="request()->routeIs('freelancer.contracts.index')">
        All Contracts
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('freelancer.contracts.open') }}"
        icon='far-folder-open'
        :active="request()->routeIs('freelancer.contracts.open')">
        Open Contracts
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('freelancer.contracts.in_progress') }}"
        icon='fas-envelope-open-text'
        :active="request()->routeIs('freelancer.contracts.in_progress')">
        In Progress Contracts
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('freelancer.contracts.rejected') }}"
        icon='far-rectangle-xmark'
        :active="request()->routeIs('freelancer.contracts.rejected')">
        Cancelled Contracts
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('freelancer.contracts.cancelled') }}"
        icon='far-circle-xmark'
        :active="request()->routeIs('freelancer.contracts.cancelled')">
        Cancelled Contracts
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('freelancer.contracts.completed') }}"
        icon='fas-pen'
        :active="request()->routeIs('freelancer.contracts.completed')">
        Completed Contracts
    </x-layouts.sidebar-two-level-link>
</x-layouts.sidebar-two-level-link-parent>

<x-layouts.sidebar-two-level-link-parent title="Certifications"
    icon='fas-certificate'
    :active="request()->routeIs('freelancer.certifications*')">
    <x-layouts.sidebar-two-level-link
        href="{{ route('freelancer.certifications.index') }}"
        icon='fas-border-all'
        :active="request()->routeIs('freelancer.certifications.index')">
        Certifications
    </x-layouts.sidebar-two-level-link>
    <x-layouts.sidebar-two-level-link
        href="{{ route('freelancer.certifications.create') }}"
        icon='fas-pen-fancy'
        :active="request()->routeIs('freelancer.certifications.create')">
        Create Certifications
    </x-layouts.sidebar-two-level-link>
</x-layouts.sidebar-two-level-link-parent>

<x-layouts.sidebar-link href="{{ route('freelancer.reviews') }}"
    icon='fas-star'
    :active="request()->routeIs('freelancer.reviews')">
    Reviews
</x-layouts.sidebar-link>

<x-layouts.sidebar-link href="{{ route('freelancer.profile.show') }}"
    icon='fas-person'
    :active="request()->routeIs('freelancer.profile.show')">
    Profile
</x-layouts.sidebar-link>
