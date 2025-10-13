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
                    {{-- <x-layouts.sidebar-two-level-link-parent title="Gigs"
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
                    </x-layouts.sidebar-two-level-link-parent> --}}

                    {{-- Contracts --}}
                    {{-- <x-layouts.sidebar-two-level-link-parent title="Contracts"
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
                    </x-layouts.sidebar-two-level-link-parent> --}}

                    <x-layouts.sidebar-link
                        href="{{ route('freelancer.reviews') }}"
                        icon='fas-star'
                        :active="request()->routeIs('freelancer.reviews')">
                        Reviews
                    </x-layouts.sidebar-link>

                    <x-layouts.sidebar-link
                        href="{{ route('freelancer.profile.show') }}"
                        icon='fas-person'
                        :active="request()->routeIs(
                            'freelancer.profile.show',
                        )">
                        Profile
                    </x-layouts.sidebar-link>
