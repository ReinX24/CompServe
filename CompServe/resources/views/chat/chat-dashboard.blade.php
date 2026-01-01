<x-layouts.app>
    <!-- Header Section -->
    <div class="mb-8">
        <x-client.page-header-with-action title="💬 Conversations"
            description="All your chats in one place." />
    </div>

    <div class="container mx-auto px-4 md:px-6 py-6 max-w-6xl">
        <!-- Enhanced Search Bar -->
        <div class="mb-6 relative">
            <div class="relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-base-content/40 pointer-events-none"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input id="user-search"
                    type="text"
                    placeholder="Search users..."
                    class="input input-bordered w-full pl-12 pr-4 h-14 text-base focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all" />
            </div>
            <!-- Search Results Dropdown -->
            <ul id="search-results"
                class="absolute w-full bg-base-100 border border-base-300 rounded-lg shadow-xl mt-2 hidden z-50 max-h-80 overflow-y-auto">
            </ul>
        </div>

        <!-- Conversations List -->
        <div class="overflow-x-auto">
            <ul id="conversations-list"
                class="menu w-full shadow-lg space-y-2 p-2">
                @foreach ($users as $user)
                    <li id="conversation-{{ $user->id }}"
                        data-user-id="{{ $user->id }}"
                        class="hover:scale-[1.01] transition-transform duration-200">
                        <a href="{{ route('chat.show', $user->id) }}"
                            class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-5 bg-base-100 hover:bg-base-200 text-neutral rounded-xl transition-all gap-3 sm:gap-4 border border-transparent hover:border-primary/20 hover:shadow-md group">
                            <div
                                class="flex items-center gap-4 w-full sm:w-auto flex-1 min-w-0">
                                <!-- Avatar -->
                                <div class="avatar relative shrink-0">
                                    <div
                                        class="w-14 h-14 rounded-full bg-linear-to-br from-primary via-primary to-secondary text-primary-content flex items-center justify-center font-bold text-lg shadow-md group-hover:shadow-lg transition-shadow">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <!-- ONLINE STATUS DOT -->
                                    <span id="user-status-{{ $user->id }}"
                                        class="absolute bottom-0 right-0 w-4 h-4 rounded-full bg-gray-400 border-[3px] border-base-100 transition-colors duration-200">
                                    </span>
                                </div>
                                <!-- User Info -->
                                <div class="flex-1 min-w-0">
                                    <p
                                        class="font-semibold text-base convo-name truncate group-hover:text-primary transition-colors">
                                        {{ $user->name }}
                                    </p>
                                    <p
                                        class="text-sm truncate w-full convo-preview text-base-content/70 mt-0.5">
                                        @if ($user->latest_message)
                                            <span
                                                class="font-medium">{{ $user->latest_message->from_id === auth()->id() ? 'You: ' : '' }}</span>{{ $user->latest_message->message ?? '' }}
                                        @else
                                            <span class="italic opacity-50">No
                                                messages yet</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <!-- Badge & Time -->
                            <div
                                class="flex flex-row sm:flex-col items-center sm:items-end gap-2 shrink-0">
                                <span
                                    class="badge badge-error badge-sm font-semibold unread-count shadow-sm {{ $user->unread_count > 0 ? '' : 'hidden' }}">
                                    {{ $user->unread_count > 99 ? '99+' : $user->unread_count }}
                                </span>
                                <span
                                    class="text-xs text-base-content/50 convo-time whitespace-nowrap">
                                    {{ $user->latest_message ? $user->latest_message->created_at->diffForHumans() : '' }}
                                </span>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <script>
        window.authId = {{ auth()->id() }};
    </script>
    @vite('resources/js/chat-dashboard.js')

    <style>
        /* Smooth scrollbar for search results */
        #search-results::-webkit-scrollbar {
            width: 8px;
        }

        #search-results::-webkit-scrollbar-track {
            background: transparent;
        }

        #search-results::-webkit-scrollbar-thumb {
            background: hsl(var(--bc) / 0.2);
            border-radius: 4px;
        }

        #search-results::-webkit-scrollbar-thumb:hover {
            background: hsl(var(--bc) / 0.3);
        }

        /* Pulse animation for online status */
        @keyframes pulse-ring {
            0% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
            }

            50% {
                box-shadow: 0 0 0 4px rgba(34, 197, 94, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0);
            }
        }

        .bg-green-500 {
            animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Smooth hover transitions */
        #conversations-list li a {
            position: relative;
            overflow: hidden;
        }

        #conversations-list li a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }

        #conversations-list li a:hover::before {
            left: 100%;
        }
    </style>
</x-layouts.app>
