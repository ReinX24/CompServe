            <aside
                :class="{
                    'w-full md:w-64': sidebarOpen,
                    'w-0 md:w-16 hidden md:block':
                        !sidebarOpen
                }"
                class="bg-sidebar text-sidebar-foreground border-r border-gray-200 dark:border-gray-700 sidebar-transition overflow-hidden">
                <!-- Sidebar Content -->
                <div class="h-full flex flex-col">
                    <!-- Sidebar Menu -->
                    <nav class="flex-1 overflow-y-auto custom-scrollbar py-4">
                        <ul class="space-y-1 px-2">
                            <!-- Dashboard -->
                            {{-- <x-layouts.sidebar-link
                                href="{{ route('dashboard') }}"
                                icon='fas-house'
                                :active="request()->routeIs('dashboard*')">Dashboard</x-layouts.sidebar-link> --}}

                            {{-- Sidebar links for freelancers --}}
                            @if (Auth::user()->role === 'freelancer')
                                {{-- Three sub categories for jobs: available jobs, current jobs, finished jobs --}}
                                <x-layouts.sidebar-link
                                    href="{{ route('freelancer.dashboard') }}"
                                    icon='fas-house'
                                    :active="request()->routeIs(
                                        'freelancer.dashboard',
                                    )">Dashboard</x-layouts.sidebar-link>

                                <x-layouts.sidebar-two-level-link-parent
                                    title="Jobs"
                                    icon='fas-pencil-alt'
                                    :active="request()->routeIs(
                                        'freelancer.jobs*',
                                    )">
                                    <x-layouts.sidebar-two-level-link
                                        href="{{ route('freelancer.jobs.available') }}"
                                        icon='far-folder-open'
                                        :active="request()->routeIs(
                                            'freelancer.jobs.available',
                                        )">Available
                                        Jobs</x-layouts.sidebar-two-level-link>
                                    <x-layouts.sidebar-two-level-link
                                        href="{{ route('freelancer.jobs.applied') }}"
                                        icon='fas-envelope-open-text'
                                        :active="request()->routeIs(
                                            'freelancer.jobs.applied',
                                        )">Applied
                                        Jobs</x-layouts.sidebar-two-level-link>
                                    <x-layouts.sidebar-two-level-link
                                        href="{{ route('freelancer.jobs.current') }}"
                                        icon='fas-pen'
                                        :active="request()->routeIs(
                                            'freelancer.jobs.current',
                                        )">Current
                                        Jobs</x-layouts.sidebar-two-level-link>
                                    <x-layouts.sidebar-two-level-link
                                        href="{{ route('freelancer.jobs.finished') }}"
                                        icon='fas-check'
                                        :active="request()->routeIs(
                                            'freelancer.jobs.finished',
                                        )">Finished
                                        Jobs</x-layouts.sidebar-two-level-link>
                                </x-layouts.sidebar-two-level-link-parent>

                                <x-layouts.sidebar-link
                                    href="{{ route('freelancer.profile.show') }}"
                                    icon='fas-person'
                                    :active="request()->routeIs(
                                        'freelancer.profile.show',
                                    )">Profile</x-layouts.sidebar-link>
                            @elseif (Auth::user()->role === 'client')
                                <x-layouts.sidebar-link
                                    href="{{ route('client.dashboard') }}"
                                    icon='fas-house'
                                    :active="request()->routeIs(
                                        'client.dashboard',
                                    )">Dashboard</x-layouts.sidebar-link>

                                <x-layouts.sidebar-two-level-link-parent
                                    title="Jobs"
                                    icon='fas-pencil-alt'
                                    :active="request()->routeIs(
                                        'client.jobs*',
                                    )">
                                    <x-layouts.sidebar-two-level-link
                                        href="{{ route('client.jobs.posts') }}"
                                        icon='far-folder-open'
                                        :active="request()->routeIs(
                                            'client.jobs.posts',
                                        )">Posted
                                        Jobs</x-layouts.sidebar-two-level-link>
                                    <x-layouts.sidebar-two-level-link
                                        href="{{ route('client.jobs.in_progress') }}"
                                        icon='fas-envelope-open-text'
                                        :active="request()->routeIs(
                                            'client.jobs.in_progress',
                                        )">In Progress
                                        Jobs</x-layouts.sidebar-two-level-link>
                                    <x-layouts.sidebar-two-level-link
                                        href="{{ route('client.jobs.completed') }}"
                                        icon='fas-pen'
                                        :active="request()->routeIs(
                                            'client.jobs.completed',
                                        )">Completed
                                        Jobs</x-layouts.sidebar-two-level-link>
                                </x-layouts.sidebar-two-level-link-parent>
                            @endif

                            <!-- Example two level -->
                            {{-- <x-layouts.sidebar-two-level-link-parent
                                title="Example two level"
                                icon="fas-house"
                                :active="request()->routeIs('two-level*')">
                                <x-layouts.sidebar-two-level-link href="#"
                                    icon='fas-house'
                                    :active="request()->routeIs('two-level*')">Child</x-layouts.sidebar-two-level-link>
                            </x-layouts.sidebar-two-level-link-parent> --}}

                            <!-- Example three level -->
                            {{-- <x-layouts.sidebar-two-level-link-parent
                                title="Example three level"
                                icon="fas-house"
                                :active="request()->routeIs('three-level*')">
                                <x-layouts.sidebar-two-level-link href="#"
                                    icon='fas-house'
                                    :active="request()->routeIs(
                                        'three-level*',
                                    )">Single
                                    Link</x-layouts.sidebar-two-level-link>

                                <x-layouts.sidebar-three-level-parent
                                    title="Third Level"
                                    icon="fas-house"
                                    :active="request()->routeIs(
                                        'three-level*',
                                    )">
                                    <x-layouts.sidebar-three-level-link
                                        href="#"
                                        :active="request()->routeIs(
                                            'three-level*',
                                        )">
                                        Third Level Link
                                    </x-layouts.sidebar-three-level-link>
                                </x-layouts.sidebar-three-level-parent>
                            </x-layouts.sidebar-two-level-link-parent> --}}
                        </ul>
                    </nav>
                </div>
            </aside>
