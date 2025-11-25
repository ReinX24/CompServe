<x-layouts.app>

    <div class="mb-6">
        <h1 class="text-2xl font-bold">
            {{ __('Freelancer Dashboard') }}</h1>
        <p class="text-gray-600 mt-1">
            {{ __('Welcome to the dashboard') }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="rounded-lg shadow-sm p-6 border bg-base-200 border-neutral">
            <div class="flex items-center justify-between text-base">
                <div>
                    <p class="text-sm font-medium">
                        {{ __('Available Gigs / Contracts') }}</p>
                    <p class="text-2xl font-bold mt-1">
                        {{ $availableJobsCount ?? '--' }}
                    </p>
                    {{-- <p class="text-xs flex items-center mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 mr-1"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        {{ __('No data') }}
                    </p> --}}
                </div>
                <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-blue-500 dark:text-blue-300"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-lg shadow-sm p-6 border bg-base-200 border-neutral">
            <div class="flex items-center justify-between text-base">
                <div>
                    <p class="text-sm font-medium">
                        {{ __('Applied Gigs / Contracts') }}</p>
                    <p class="text-2xl font-bold mt-1">
                        {{ $appliedJobsCount ?? '--' }}</p>
                    {{-- <p class="text-xs flex items-center mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 mr-1"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        {{ __('No data') }}
                    </p> --}}
                </div>
                <div class="bg-green-100 dark:bg-green-900 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        class="h-6 w-6 text-green-500 dark:text-green-300"
                        stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-lg shadow-sm p-6 border bg-base-200 border-neutral">
            <div class="flex items-center justify-between text-base">
                <div>
                    <p class="text-sm font-medium">
                        {{ __('In-progress Gigs / Contracts') }}</p>
                    <p class="text-2xl font-bold mt-1">
                        {{ $currentJobsCount ?? '--' }}</p>
                    {{-- <p class="text-xs text-gray-500 flex items-center mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 mr-1"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        {{ __('No data') }}
                    </p> --}}
                </div>
                <div class="bg-purple-100 dark:bg-purple-900 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-purple-500 dark:text-purple-300"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-lg shadow-sm p-6 border bg-base-200 border-neutral">
            <div class="flex items-center justify-between text-base">
                <div>
                    <p class="text-sm font-medium">
                        {{ __('Completed Gigs / Contracts') }}</p>
                    <p class="text-2xl font-bold mt-1">
                        {{ $completedJobsCount ?? '--' }}</p>
                    {{-- <p class="text-xs text-gray-500 flex items-center mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 mr-1"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        {{ __('No data') }}
                    </p> --}}
                </div>
                <div class="bg-orange-100 dark:bg-orange-900 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-orange-500 dark:text-orange-300"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
