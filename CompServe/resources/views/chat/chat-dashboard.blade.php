<x-layouts.app>
    <div class="container mx-auto px-4 md:px-6 py-6">

        <!-- Page Header -->
        <h1 class="text-3xl font-bold mb-6">💬 Conversations</h1>

        <div class="mb-4 relative">
            <input id="user-search"
                type="text"
                placeholder="Search users..."
                class="input input-bordered w-full" />

            <!-- Search Results Dropdown -->
            <ul id="search-results"
                class="absolute w-full bg-base-100 border rounded shadow mt-1 hidden z-50">
            </ul>
        </div>

        <!-- Conversations List -->
        <div class="overflow-x-auto">
            <ul id="conversations-list"
                class="menu bg-base-100 rounded-box w-full shadow-lg divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($users as $user)
                    <li id="conversation-{{ $user->id }}"
                        data-user-id="{{ $user->id }}">
                        <a href="{{ route('chat.show', $user->id) }}"
                            class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 bg-base-200 hover:bg-base-300 text-neutral rounded-lg transition gap-2 sm:gap-0">

                            <div
                                class="flex items-center gap-4 w-full sm:w-auto">
                                <div class="avatar relative flex-shrink-0">
                                    <div
                                        class="w-12 h-12 rounded-full bg-primary text-primary-content flex items-center justify-center font-bold text-lg">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>

                                    <!-- ONLINE STATUS DOT -->
                                    <span id="user-status-{{ $user->id }}"
                                        class="absolute bottom-0 right-0 w-3 h-3 rounded-full bg-gray-400 border-2 border-base-100">
                                    </span>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <p
                                        class="font-semibold convo-name truncate">
                                        {{ $user->name }}</p>

                                    <p
                                        class="text-sm truncate w-full convo-preview">
                                        {{ $user->latest_message->from_id === auth()->id() ? 'You: ' : '' }}
                                        {{ $user->latest_message->message ?? '' }}
                                    </p>
                                </div>
                            </div>

                            <div
                                class="flex flex-row sm:flex-col items-center sm:items-end gap-2 mt-2 sm:mt-0">
                                <span
                                    class="badge badge-error unread-count {{ $user->unread_count > 0 ? '' : 'hidden' }}">
                                    {{ $user->unread_count }}
                                </span>

                                <span
                                    class="text-xs text-gray-400 dark:text-gray-500 convo-time truncate">
                                    {{ $user->latest_message->created_at->diffForHumans() }}
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
</x-layouts.app>
