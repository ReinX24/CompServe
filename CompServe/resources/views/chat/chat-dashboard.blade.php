<x-layouts.app>
    <div class="container mx-auto px-4 md:px-6 py-6">

        <!-- Page Header -->
        <h1 class="text-3xl font-bold mb-6">💬 Conversations</h1>

        <!-- Conversations List -->
        <div class="overflow-x-auto">
            <ul
                class="menu bg-base-100 rounded-box w-full shadow-lg divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($users as $user)
                    <li>
                        <a href="{{ route('chat.show', $user->id) }}"
                            class="flex items-center justify-between p-4 bg-base-200 hover:bg text-neutral rounded-lg transition">

                            <!-- User Info -->
                            <div class="flex items-center gap-4">
                                <div class="avatar">
                                    <div
                                        class="w-12 h-12 rounded-full bg-primary text-primary-content flex items-center justify-center font-bold text-lg">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                </div>
                                <div>
                                    <p class="font-semibold">
                                        {{ $user->name }}</p>
                                    @if ($user->latest_message)
                                        <p class="text-sm truncate w-64">
                                            {{ $user->latest_message->from_id === auth()->id() ? 'You: ' : '' }}
                                            {{ $user->latest_message->message }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <!-- Message Meta -->
                            {{-- TODO: implement the unread_count and latest_message --}}
                            <div class="flex flex-col items-end gap-1">
                                @if ($user->unread_count > 0)
                                    <span
                                        class="badge badge-error">{{ $user->unread_count }}</span>
                                @endif
                                @if ($user->latest_message)
                                    <span
                                        class="text-xs text-gray-400 dark:text-gray-500">
                                        {{ $user->latest_message->created_at->diffForHumans() }}
                                    </span>
                                @endif
                            </div>

                        </a>
                    </li>
                @empty
                    <li class="p-4 text-gray-500 dark:text-gray-400">No
                        conversations yet.</li>
                @endforelse
            </ul>
        </div>
    </div>
</x-layouts.app>
