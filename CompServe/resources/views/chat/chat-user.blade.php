<x-layouts.app>

    <!-- Chat Header -->
    <div
        class="mb-4 bg-base-100 rounded-xl shadow-lg border-2 border-base-200 p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <!-- Back Button -->
                <a href="{{ route('chat.dashboard') }}"
                    class="btn btn-ghost btn-circle hover:bg-base-200 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="w-6 h-6">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </a>

                <!-- Recipient Avatar and Info -->
                <div class="flex items-center gap-3">
                    <div class="avatar relative">
                        <div
                            class="w-12 h-12 rounded-full bg-gradient-to-br from-primary to-primary/70 text-white flex items-center justify-center font-bold text-lg shadow-md">
                            {{ strtoupper(substr($recipient->name, 0, 2)) }}
                        </div>
                        <span id="user-status"
                            class="absolute bottom-0 right-0 w-3.5 h-3.5 rounded-full bg-gray-400 border-2 border-base-100"></span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-base-content">
                            {{ $recipient->name }}
                        </h2>
                        <p id="typing-indicator"
                            class="text-xs text-base-content/60 hidden">
                            <span class="inline-flex gap-1">
                                <span class="animate-bounce"
                                    style="animation-delay: 0ms">•</span>
                                <span class="animate-bounce"
                                    style="animation-delay: 150ms">•</span>
                                <span class="animate-bounce"
                                    style="animation-delay: 300ms">•</span>
                            </span>
                            typing...
                        </p>
                    </div>
                </div>
            </div>

            <!-- Chat Actions -->
            {{-- <div class="flex items-center gap-2">
                <button class="btn btn-ghost btn-circle btn-sm"
                    title="Search messages">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-5 h-5">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </button>
                <div class="dropdown dropdown-end">
                    <button tabindex="0"
                        class="btn btn-ghost btn-circle btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                        </svg>
                    </button>
                    <ul tabindex="0"
                        class="dropdown-content z-[1] menu p-2 shadow-xl bg-base-100 rounded-box w-52 border border-base-300">
                        <li><a>View Profile</a></li>
                        <li><a>Mute Notifications</a></li>
                        <li><a class="text-error">Clear Chat</a></li>
                    </ul>
                </div>
            </div> --}}
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4">

        <!-- Chat Box -->
        <div
            class="bg-base-100 rounded-xl shadow-lg border-2 border-base-200 overflow-hidden">
            <div id="chat-box"
                class="p-6 h-[500px] overflow-y-auto bg-gradient-to-b from-base-100 to-base-200/30 space-y-3 scroll-smooth">
                @foreach ($messages as $message)
                    <div
                        class="message flex {{ $message->from_id == auth()->id() ? 'justify-end' : 'justify-start' }} animate-fade-in">
                        <div
                            class="max-w-[75%] {{ $message->from_id == auth()->id() ? 'order-1' : 'order-2' }}">
                            <!-- Message Bubble -->
                            <div class="relative group">
                                <div
                                    class="px-4 py-3 rounded-2xl shadow-md transition-all duration-200 hover:shadow-lg
                                    {{ $message->from_id == auth()->id()
                                        ? 'bg-primary text-primary-content rounded-br-sm'
                                        : 'bg-base-200 text-base-content rounded-bl-sm' }}">

                                    <!-- Sender Name (only for received messages) -->
                                    @if ($message->from_id != auth()->id())
                                        <strong
                                            class="block text-xs opacity-70 mb-1 font-semibold">
                                            {{ $recipient->name }}
                                        </strong>
                                    @endif

                                    <!-- Message Content -->
                                    <p
                                        class="text-sm leading-relaxed break-words">
                                        {{ $message->message }}
                                    </p>

                                    <!-- Message Time and Status -->
                                    <div
                                        class="flex items-center justify-end gap-1 mt-1">
                                        <span class="text-[10px] opacity-70">
                                            {{ $message->created_at->format('g:i A') }}
                                        </span>
                                        @if ($message->from_id == auth()->id())
                                            <span
                                                class="text-[10px] opacity-70">
                                                {{ $message->read_at ? '✓✓' : '✓' }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Message Actions (visible on hover) -->
                                <div
                                    class="absolute top-1/2 -translate-y-1/2 {{ $message->from_id == auth()->id() ? '-left-10' : '-right-10' }} opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button
                                        class="btn btn-ghost btn-circle btn-xs"
                                        title="React">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-4 h-4">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Message Input Area -->
            <div class="border-t-2 border-base-200 bg-base-100 p-4">
                <div class="flex items-end gap-3">
                    <!-- Attachment Button -->
                    {{-- <button
                        class="btn btn-ghost btn-circle hover:bg-base-200 shrink-0"
                        title="Attach file">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
                        </svg>
                    </button> --}}

                    <!-- Message Input -->
                    <div class="flex-1 relative">
                        <input id="message-input"
                            type="text"
                            placeholder="Type a message..."
                            class="input input-bordered w-full h-12 pr-12 rounded-xl border-2 focus:border-primary transition-all"
                            autocomplete="off" />

                        <!-- Emoji Button -->
                        {{-- <button
                            class="absolute right-3 top-1/2 -translate-y-1/2 btn btn-ghost btn-circle btn-sm"
                            title="Add emoji">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-5 h-5">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                            </svg>
                        </button> --}}
                    </div>

                    <!-- Send Button -->
                    <button id="send-btn"
                        class="btn btn-primary btn-circle btn-lg shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="w-6 h-6">
                            <path
                                d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                        </svg>
                    </button>
                </div>

                <!-- Character Count / Status (optional) -->
                {{-- <div class="text-xs text-base-content/40 mt-2 text-center">
                    Press Enter to send • Shift + Enter for new line
                </div> --}}
            </div>
        </div>
    </div>

    <script>
        window.authId = {{ auth()->id() }};
        window.userId = {{ auth()->id() }};
        window.recipientId = {{ $recipient->id }};
        window.recipientName = "{{ $recipient->name }}";

        // Auto scroll to bottom on load
        const chatBox = document.getElementById("chat-box");
        chatBox.scrollTop = chatBox.scrollHeight;

        // Enhanced: Smooth scroll to bottom function
        function scrollToBottom(smooth = true) {
            if (smooth) {
                chatBox.scrollTo({
                    top: chatBox.scrollHeight,
                    behavior: 'smooth'
                });
            } else {
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        }

        // Enhanced: Add Enter key support for sending messages
        const messageInput = document.getElementById('message-input');
        const sendBtn = document.getElementById('send-btn');

        messageInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendBtn.click();
            }
        });

        // Enhanced: Focus input on load
        messageInput.focus();
    </script>

    @vite(['resources/js/chat.js'])

    <style>
        /* Smooth animations */
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }

        /* Custom scrollbar for chat box */
        #chat-box::-webkit-scrollbar {
            width: 8px;
        }

        #chat-box::-webkit-scrollbar-track {
            background: transparent;
        }

        #chat-box::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }

        #chat-box::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.3);
        }

        /* Smooth bounce animation for typing indicator */
        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-4px);
            }
        }

        .animate-bounce {
            animation: bounce 1s infinite;
        }

        /* Message bubble hover effect */
        .message:hover .group>div {
            transform: scale(1.01);
        }
    </style>
</x-layouts.app>
