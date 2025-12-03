<x-layouts.app>
    <x-client.page-header-with-action title="💬 Conversations"
        description="Stay connected with your network." />

    <div class="container mx-auto px-4 md:px-6 py-6 max-w-5xl">
        <!-- Enhanced Search Bar -->
        <div class="mb-6 relative">
            <div class="relative group">
                {{-- <div
                    class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-5 h-5 text-base-content/40 group-focus-within:text-primary transition-colors">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div> --}}
                <input id="user-search"
                    type="text"
                    placeholder="Search conversations..."
                    class="input input-bordered w-full pl-12 pr-4 h-14 bg-base-100 border-2 border-base-300 focus:border-primary focus:outline-none transition-all duration-200 rounded-xl shadow-sm hover:shadow-md" />
            </div>
            <!-- Search Results Dropdown -->
            <ul id="search-results"
                class="absolute w-full bg-base-100 border-2 border-base-300 rounded-xl shadow-xl mt-2 hidden z-50 overflow-hidden">
            </ul>
        </div>

        <!-- Conversations List -->
        <div class="space-y-2">
            @forelse ($users as $user)
                <div id="conversation-{{ $user->id }}"
                    data-user-id="{{ $user->id }}"
                    class="group bg-base-100 rounded-xl border-2 border-base-200 hover:border-primary/30 transition-all duration-200 hover:shadow-lg overflow-hidden">
                    <a href="{{ route('chat.show', $user->id) }}"
                        class="flex items-center justify-between p-4 gap-4">
                        <!-- Left Side: Avatar and Info -->
                        <div class="flex items-center gap-4 flex-1 min-w-0">
                            <!-- Avatar with Online Status -->
                            <div class="avatar relative shrink-0">
                                <div
                                    class="w-14 h-14 rounded-full bg-gradient-to-br from-primary to-primary/70 text-white flex items-center justify-center font-bold text-lg shadow-md group-hover:scale-105 transition-transform">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <!-- Enhanced Online Status Indicator -->
                                <span id="user-status-{{ $user->id }}"
                                    class="absolute bottom-0 right-0 w-4 h-4 rounded-full bg-gray-400 border-2 border-base-100 shadow-sm">
                                </span>
                            </div>

                            <!-- User Info -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <p
                                        class="font-semibold text-base-content convo-name truncate text-lg">
                                        {{ $user->name }}
                                    </p>
                                    @if ($user->unread_count > 0)
                                        <span
                                            class="badge badge-primary badge-sm font-semibold animate-pulse">
                                            New
                                        </span>
                                    @endif
                                </div>
                                <p
                                    class="text-sm text-base-content/60 truncate convo-preview flex items-center gap-1">
                                    @if ($user->latest_message)
                                        @if ($user->latest_message->from_id === auth()->id())
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                class="w-4 h-4 text-primary shrink-0">
                                                <path
                                                    d="M3.105 2.288a.75.75 0 0 0-.826.95l1.414 4.926A1.5 1.5 0 0 0 5.135 9.25h6.115a.75.75 0 0 1 0 1.5H5.135a1.5 1.5 0 0 0-1.442 1.086l-1.414 4.926a.75.75 0 0 0 .826.95 28.897 28.897 0 0 0 15.293-7.155.75.75 0 0 0 0-1.114A28.897 28.897 0 0 0 3.105 2.288Z" />
                                            </svg>
                                            <span
                                                class="truncate">{{ $user->latest_message->message }}</span>
                                        @else
                                            <span
                                                class="truncate">{{ $user->latest_message->message }}</span>
                                        @endif
                                    @else
                                        <span
                                            class="italic text-base-content/40">No
                                            messages yet</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Right Side: Time and Unread Badge -->
                        <div class="flex flex-col items-end gap-2 shrink-0">
                            @if ($user->unread_count > 0)
                                <div
                                    class="badge badge-error text-white font-bold min-w-[1.5rem] h-6 unread-count shadow-md">
                                    {{ $user->unread_count > 99 ? '99+' : $user->unread_count }}
                                </div>
                            @else
                                <div class="unread-count hidden"></div>
                            @endif
                            @if ($user->latest_message)
                                <span
                                    class="text-xs text-base-content/50 convo-time whitespace-nowrap">
                                    {{ $user->latest_message->created_at->diffForHumans() }}
                                </span>
                            @endif
                        </div>
                    </a>
                </div>
            @empty
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div
                        class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-base-200 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-10 h-10 text-base-content/40">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-base-content mb-2">No
                        conversations yet</h3>
                    <p class="text-base-content/60">Start a conversation to see
                        it here</p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        window.authId = {{ auth()->id() }};
    </script>
    @vite('resources/js/chat-dashboard.js')

    <style>
        /* Custom animations */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #search-results:not(.hidden) {
            animation: slideIn 0.2s ease-out;
        }

        /* Smooth hover effects */
        .group:hover .avatar>div {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        /* Custom scrollbar for better aesthetics */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.3);
        }
    </style>
</x-layouts.app>
