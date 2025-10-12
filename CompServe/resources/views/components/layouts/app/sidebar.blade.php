<aside x-show="sidebarOpen"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="-translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="-translate-x-full opacity-0"
    class="fixed inset-y-0 left-0 z-30 w-64 bg-sidebar text-sidebar-foreground border-r border-gray-200 dark:border-gray-700 shadow-lg pt-16">

    <!-- Sidebar Content -->
    <div class="h-full flex flex-col">
        <!-- Sidebar Menu -->
        <nav class="flex-1 overflow-y-auto custom-scrollbar py-4">
            <ul class="space-y-1 px-2">
                {{-- Freelancer --}}
                @if (Auth::user()->role === 'freelancer')
                    <x-layouts.sidebar-link
                        href="{{ route('freelancer.dashboard') }}"
                        icon='fas-house'
                        :active="request()->routeIs('freelancer.dashboard')">
                        Dashboard
                    </x-layouts.sidebar-link>

                    <x-layouts.sidebar-two-level-link-parent title="Jobs"
                        icon='fas-pencil-alt'
                        :active="request()->routeIs('freelancer.jobs*')">
                        <x-layouts.sidebar-two-level-link
                            href="{{ route('freelancer.jobs.available') }}"
                            icon='far-folder-open'
                            :active="request()->routeIs(
                                'freelancer.jobs.available',
                            )">
                            Available Jobs
                        </x-layouts.sidebar-two-level-link>
                        <x-layouts.sidebar-two-level-link
                            href="{{ route('freelancer.jobs.applied') }}"
                            icon='fas-envelope-open-text'
                            :active="request()->routeIs(
                                'freelancer.jobs.applied',
                            )">
                            Applied Jobs
                        </x-layouts.sidebar-two-level-link>
                        <x-layouts.sidebar-two-level-link
                            href="{{ route('freelancer.jobs.current') }}"
                            icon='fas-pen'
                            :active="request()->routeIs(
                                'freelancer.jobs.current',
                            )">
                            Accepted Jobs
                        </x-layouts.sidebar-two-level-link>
                        <x-layouts.sidebar-two-level-link
                            href="{{ route('freelancer.jobs.rejected') }}"
                            icon='far-circle-xmark'
                            :active="request()->routeIs(
                                'freelancer.jobs.rejected',
                            )">
                            Rejected Jobs
                        </x-layouts.sidebar-two-level-link>
                        <x-layouts.sidebar-two-level-link
                            href="{{ route('freelancer.jobs.finished') }}"
                            icon='fas-check'
                            :active="request()->routeIs(
                                'freelancer.jobs.finished',
                            )">
                            Finished Jobs
                        </x-layouts.sidebar-two-level-link>
                    </x-layouts.sidebar-two-level-link-parent>

                    {{-- Gigs --}}
                    <x-layouts.sidebar-two-level-link-parent title="Gigs"
                        icon='fas-pen-alt'
                        :active="request()->routeIs('freelancer.jobs*')">
                        <x-layouts.sidebar-two-level-link
                            href="{{ route('freelancer.jobs.available') }}"
                            icon='far-folder-open'
                            :active="request()->routeIs(
                                'freelancer.jobs.available',
                            )">
                            Available Jobs
                        </x-layouts.sidebar-two-level-link>
                        <x-layouts.sidebar-two-level-link
                            href="{{ route('freelancer.jobs.applied') }}"
                            icon='fas-envelope-open-text'
                            :active="request()->routeIs(
                                'freelancer.jobs.applied',
                            )">
                            Applied Jobs
                        </x-layouts.sidebar-two-level-link>
                        <x-layouts.sidebar-two-level-link
                            href="{{ route('freelancer.jobs.current') }}"
                            icon='fas-pen'
                            :active="request()->routeIs(
                                'freelancer.jobs.current',
                            )">
                            Accepted Jobs
                        </x-layouts.sidebar-two-level-link>
                        <x-layouts.sidebar-two-level-link
                            href="{{ route('freelancer.jobs.rejected') }}"
                            icon='far-circle-xmark'
                            :active="request()->routeIs(
                                'freelancer.jobs.rejected',
                            )">
                            Rejected Jobs
                        </x-layouts.sidebar-two-level-link>
                        <x-layouts.sidebar-two-level-link
                            href="{{ route('freelancer.jobs.finished') }}"
                            icon='fas-check'
                            :active="request()->routeIs(
                                'freelancer.jobs.finished',
                            )">
                            Finished Jobs
                        </x-layouts.sidebar-two-level-link>
                    </x-layouts.sidebar-two-level-link-parent>

                    {{-- Contracts --}}
                    <x-layouts.sidebar-two-level-link-parent title="Contracts"
                        icon='fas-pen-fancy'
                        :active="request()->routeIs('freelancer.jobs*')">
                        <x-layouts.sidebar-two-level-link
                            href="{{ route('freelancer.jobs.available') }}"
                            icon='far-folder-open'
                            :active="request()->routeIs(
                                'freelancer.jobs.available',
                            )">
                            Available Jobs
                        </x-layouts.sidebar-two-level-link>
                        <x-layouts.sidebar-two-level-link
                            href="{{ route('freelancer.jobs.applied') }}"
                            icon='fas-envelope-open-text'
                            :active="request()->routeIs(
                                'freelancer.jobs.applied',
                            )">
                            Applied Jobs
                        </x-layouts.sidebar-two-level-link>
                        <x-layouts.sidebar-two-level-link
                            href="{{ route('freelancer.jobs.current') }}"
                            icon='fas-pen'
                            :active="request()->routeIs(
                                'freelancer.jobs.current',
                            )">
                            Accepted Jobs
                        </x-layouts.sidebar-two-level-link>
                        <x-layouts.sidebar-two-level-link
                            href="{{ route('freelancer.jobs.rejected') }}"
                            icon='far-circle-xmark'
                            :active="request()->routeIs(
                                'freelancer.jobs.rejected',
                            )">
                            Rejected Jobs
                        </x-layouts.sidebar-two-level-link>
                        <x-layouts.sidebar-two-level-link
                            href="{{ route('freelancer.jobs.finished') }}"
                            icon='fas-check'
                            :active="request()->routeIs(
                                'freelancer.jobs.finished',
                            )">
                            Finished Jobs
                        </x-layouts.sidebar-two-level-link>
                    </x-layouts.sidebar-two-level-link-parent>

                    <x-layouts.sidebar-link
                        href="{{ route('freelancer.profile.show') }}"
                        icon='fas-person'
                        :active="request()->routeIs(
                            'freelancer.profile.show',
                        )">
                        Profile
                    </x-layouts.sidebar-link>
                @elseif (Auth::user()->role === 'client')
                    <x-layouts.sidebar-link
                        href="{{ route('client.dashboard') }}"
                        icon='fas-house'
                        :active="request()->routeIs('client.dashboard')">
                        Dashboard
                    </x-layouts.sidebar-link>

                    <x-layouts.sidebar-two-level-link-parent title="Jobs"
                        icon='fas-pencil-alt'
                        :active="request()->routeIs('client.jobs*')">
                        <x-layouts.sidebar-two-level-link
                            href="{{ route('client.jobs.index') }}"
                            icon='fas-border-all'
                            :active="request()->routeIs('client.jobs.index')">
                            All Jobs
                        </x-layouts.sidebar-two-level-link>
                        <x-layouts.sidebar-two-level-link
                            href="{{ route('client.jobs.posts') }}"
                            icon='far-folder-open'
                            :active="request()->routeIs('client.jobs.posts')">
                            Posted Jobs
                        </x-layouts.sidebar-two-level-link>
                        <x-layouts.sidebar-two-level-link
                            href="{{ route('client.jobs.in_progress') }}"
                            icon='fas-envelope-open-text'
                            :active="request()->routeIs(
                                'client.jobs.in_progress',
                            )">
                            In Progress Jobs
                        </x-layouts.sidebar-two-level-link>
                        <x-layouts.sidebar-two-level-link
                            href="{{ route('client.jobs.cancelled') }}"
                            icon='far-circle-xmark'
                            :active="request()->routeIs(
                                'client.jobs.cancelled',
                            )">
                            Cancelled Jobs
                        </x-layouts.sidebar-two-level-link>
                        <x-layouts.sidebar-two-level-link
                            href="{{ route('client.jobs.completed') }}"
                            icon='fas-pen'
                            :active="request()->routeIs(
                                'client.jobs.completed',
                            )">
                            Completed Jobs
                        </x-layouts.sidebar-two-level-link>
                    </x-layouts.sidebar-two-level-link-parent>

                    <x-layouts.sidebar-link
                        href="{{ route('client.reviews') }}"
                        icon='fas-star'
                        :active="request()->routeIs('client.reviews')">
                        Reviews
                    </x-layouts.sidebar-link>

                    <x-layouts.sidebar-link
                        href="{{ route('client.profile.show') }}"
                        icon='fas-person'
                        :active="request()->routeIs('client.profile.show')">
                        Profile
                    </x-layouts.sidebar-link>
                @endif
            </ul>
        </nav>
    </div>
</aside>

<!-- Backdrop overlay -->
<div x-show="sidebarOpen"
    @click="toggleSidebar"
    x-transition.opacity
    class="fixed inset-0 bg-black/30 z-20 lg:hidden"></div>
