<x-layouts.app>
    <!-- Header Section -->
    <div class="mb-4 sm:mb-6 md:mb-8">
        <x-client.page-header-with-action title="💬 Conversations"
            description="All your chats in one place." />
    </div>

    <div class="container mx-auto px-3 sm:px-4 md:px-6 py-4 sm:py-6 max-w-6xl">
        <!-- Enhanced Search Bar with Filter Options -->
        <div class="mb-4 sm:mb-6 space-y-3">
            <div class="relative">
                <svg class="absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 w-4 h-4 sm:w-5 sm:h-5 text-base-content/40 pointer-events-none"
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
                    placeholder="Search conversations..."
                    class="input input-bordered w-full pl-10 sm:pl-12 pr-4 h-12 sm:h-14 text-sm sm:text-base focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all" />
                <!-- Clear Search Button -->
                <button id="clear-search"
                    class="absolute right-3 top-1/2 -translate-y-1/2 hidden text-base-content/40 hover:text-base-content transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Filter Tabs -->
            <div class="flex gap-2 overflow-x-auto pb-2 hide-scrollbar">
                <button class="filter-btn btn btn-sm sm:btn-md btn-primary shrink-0" data-filter="all">
                    All <span class="badge badge-sm ml-1">{{ $users->count() }}</span>
                </button>
                <button class="filter-btn btn btn-sm sm:btn-md btn-ghost shrink-0" data-filter="unread">
                    Unread <span class="badge badge-sm badge-error ml-1">{{ $users->where('unread_count', '>', 0)->count() }}</span>
                </button>
                <button class="filter-btn btn btn-sm sm:btn-md btn-ghost shrink-0" data-filter="online">
                    <span class="w-2 h-2 rounded-full bg-green-500 mr-1"></span> Online
                </button>
            </div>

            <!-- Search Results Dropdown -->
            <ul id="search-results"
                class="absolute w-[calc(100%-1.5rem)] sm:w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] bg-base-100 border border-base-300 rounded-lg shadow-xl mt-2 hidden z-50 max-h-80 overflow-y-auto">
            </ul>
        </div>

        <!-- Stats Overview (Optional Enhancement) -->
        <div class="grid grid-cols-3 gap-2 sm:gap-4 mb-4 sm:mb-6">
            <div class="stat bg-base-100 rounded-lg shadow-sm p-3 sm:p-4 border border-base-300/50">
                <div class="stat-value text-lg sm:text-2xl text-primary">{{ $users->count() }}</div>
                <div class="stat-title text-xs sm:text-sm">Conversations</div>
            </div>
            <div class="stat bg-base-100 rounded-lg shadow-sm p-3 sm:p-4 border border-base-300/50">
                <div class="stat-value text-lg sm:text-2xl text-error">{{ $users->where('unread_count', '>', 0)->count() }}</div>
                <div class="stat-title text-xs sm:text-sm">Unread</div>
            </div>
            <div class="stat bg-base-100 rounded-lg shadow-sm p-3 sm:p-4 border border-base-300/50">
                <div class="stat-value text-lg sm:text-2xl text-success" id="online-count">0</div>
                <div class="stat-title text-xs sm:text-sm">Online</div>
            </div>
        </div>

        <!-- Empty State -->
        <div id="empty-state" class="hidden text-center py-12 sm:py-16">
            <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-base-200 rounded-full mb-4">
                <span class="text-4xl sm:text-5xl">🔍</span>
            </div>
            <h3 class="text-lg sm:text-xl font-bold mb-2">No conversations found</h3>
            <p class="text-sm sm:text-base text-base-content/60">Try adjusting your search or filters</p>
        </div>

        <!-- Conversations List -->
        <div class="overflow-visible">
            <ul id="conversations-list"
                class="space-y-2 sm:space-y-3 px-1">
                @foreach ($users as $user)
                    <li id="conversation-{{ $user->id }}"
                        data-user-id="{{ $user->id }}"
                        data-user-name="{{ strtolower($user->name) }}"
                        data-unread="{{ $user->unread_count }}"
                        class="conversation-item hover:scale-[1.01] transition-transform duration-200">
                        <a href="{{ route('chat.show', $user->id) }}"
                            class="flex items-center justify-between p-3 sm:p-4 md:p-5 bg-base-100 hover:bg-base-200 text-neutral rounded-lg sm:rounded-xl transition-all gap-3 sm:gap-4 border border-transparent hover:border-primary/20 hover:shadow-md group">
                            <div
                                class="flex items-center gap-2 sm:gap-3 md:gap-4 flex-1 min-w-0">
                                <!-- Avatar -->
                                <div class="avatar relative shrink-0">
                                    <div
                                        class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-full bg-linear-to-br from-primary via-primary to-secondary text-primary-content flex items-center justify-center font-bold text-sm sm:text-base md:text-lg shadow-md group-hover:shadow-lg transition-shadow">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <!-- ONLINE STATUS DOT -->
                                    <span id="user-status-{{ $user->id }}"
                                        class="absolute bottom-0 right-0 w-3 h-3 sm:w-3.5 sm:h-3.5 md:w-4 md:h-4 rounded-full bg-gray-400 border-2 sm:border-[3px] border-base-100 transition-colors duration-200">
                                    </span>
                                </div>
                                <!-- User Info -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-0.5 sm:mb-1">
                                        <p class="font-semibold text-sm sm:text-base convo-name truncate group-hover:text-primary transition-colors">
                                            {{ $user->name }}
                                        </p>
                                        <!-- Mobile: Show unread badge inline with name -->
                                        <span class="badge badge-error badge-xs sm:hidden unread-count {{ $user->unread_count > 0 ? '' : 'hidden' }}">
                                            {{ $user->unread_count > 99 ? '99+' : $user->unread_count }}
                                        </span>
                                    </div>
                                    <p class="text-xs sm:text-sm truncate convo-preview text-base-content/70">
                                        @if ($user->latest_message)
                                            <span class="font-medium">{{ $user->latest_message->from_id === auth()->id() ? 'You: ' : '' }}</span>{{ $user->latest_message->message ?? '' }}
                                        @else
                                            <span class="italic opacity-50">No messages yet</span>
                                        @endif
                                    </p>
                                    <!-- Mobile: Show time below message -->
                                    <span class="text-xs text-base-content/50 convo-time sm:hidden mt-1 block">
                                        {{ $user->latest_message ? $user->latest_message->created_at->diffForHumans() : '' }}
                                    </span>
                                </div>
                            </div>
                            <!-- Badge & Time - Desktop Only -->
                            <div class="hidden sm:flex flex-col items-end gap-1.5 shrink-0">
                                <span class="badge badge-error badge-sm font-semibold unread-count shadow-sm {{ $user->unread_count > 0 ? '' : 'hidden' }}">
                                    {{ $user->unread_count > 99 ? '99+' : $user->unread_count }}
                                </span>
                                <span class="text-xs text-base-content/50 convo-time whitespace-nowrap">
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

        // Search functionality
        const searchInput = document.getElementById('user-search');
        const clearSearchBtn = document.getElementById('clear-search');
        const conversationItems = document.querySelectorAll('.conversation-item');
        const emptyState = document.getElementById('empty-state');

        searchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase().trim();
            clearSearchBtn.classList.toggle('hidden', !searchTerm);
            filterConversations();
        });

        clearSearchBtn.addEventListener('click', () => {
            searchInput.value = '';
            clearSearchBtn.classList.add('hidden');
            filterConversations();
        });

        // Filter functionality
        const filterBtns = document.querySelectorAll('.filter-btn');
        let currentFilter = 'all';

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => {
                    b.classList.remove('btn-primary');
                    b.classList.add('btn-ghost');
                });
                btn.classList.remove('btn-ghost');
                btn.classList.add('btn-primary');
                currentFilter = btn.dataset.filter;
                filterConversations();
            });
        });

        function filterConversations() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            let visibleCount = 0;

            conversationItems.forEach(item => {
                const userName = item.dataset.userName;
                const unreadCount = parseInt(item.dataset.unread);
                const statusDot = item.querySelector('[id^="user-status-"]');
                const isOnline = statusDot && statusDot.classList.contains('bg-green-500');

                let matchesSearch = !searchTerm || userName.includes(searchTerm);
                let matchesFilter = true;

                if (currentFilter === 'unread') {
                    matchesFilter = unreadCount > 0;
                } else if (currentFilter === 'online') {
                    matchesFilter = isOnline;
                }

                const shouldShow = matchesSearch && matchesFilter;
                item.classList.toggle('hidden', !shouldShow);
                if (shouldShow) visibleCount++;
            });

            emptyState.classList.toggle('hidden', visibleCount > 0);
        }

        // Update online count
        function updateOnlineCount() {
            const onlineCount = document.querySelectorAll('.bg-green-500').length;
            document.getElementById('online-count').textContent = onlineCount;
        }

        // Call initially and whenever status updates
        setTimeout(updateOnlineCount, 1000);
    </script>
    @vite('resources/js/chat-dashboard.js')

    <style>
        /* Hide scrollbar for filter tabs */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

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

        /* Mobile optimizations */
        @media (max-width: 640px) {
            input, select, textarea {
                font-size: 16px; /* Prevents zoom on iOS */
            }
        }

        /* Extra small breakpoint for xs: prefix */
        @media (min-width: 475px) {
            .xs\:inline {
                display: inline;
            }
            .xs\:hidden {
                display: none;
            }
        }
    </style>
</x-layouts.app>