<x-layouts.app>
    <div
        class="min-h-screen bg-linear-to-br from-base-200 via-base-100 to-base-200 py-6 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Chat Container Card -->
            <div
                class="card bg-base-100 shadow-2xl border-2 border-base-200 overflow-hidden">
                <!-- Chat Header -->
                <div
                    class="bg-linear-to-r from-primary/10 via-secondary/10 to-accent/10 border-b-2 border-base-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between gap-4">
                            <!-- Recipient Info -->
                            <div class="flex items-center gap-4">
                                <!-- Avatar -->
                                <div class="avatar avatar-placeholder">
                                    <div
                                        class="w-14 h-14 rounded-full bg-linear-to-br from-primary to-secondary text-primary-content ring ring-primary/20 ring-offset-2 ring-offset-base-100">
                                        <span class="text-xl font-bold">
                                            {{ strtoupper(substr($recipient->name, 0, 1)) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Name & Status -->
                                <div>
                                    <h2
                                        class="text-2xl font-bold text-base-content flex items-center gap-2">
                                        {{ $recipient->name }}
                                        <div
                                            class="badge badge-success badge-sm gap-1">
                                            <span
                                                class="w-2 h-2 bg-success rounded-full animate-pulse"></span>
                                            Online
                                        </div>
                                    </h2>
                                    <p
                                        class="text-sm text-base-content/60 mt-1">
                                        {{ ucfirst($recipient->role) }}
                                    </p>
                                </div>
                            </div>

                            <!-- View Profile Link -->
                            @if ($recipient->role === 'client')
                                <a href="{{ route('client.profile', $recipient->id) }}"
                                    class="btn btn-ghost btn-sm gap-2 hover:bg-primary/10">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-5 h-5">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    <span class="hidden sm:inline">View
                                        Profile</span>
                                </a>
                            @elseif($recipient->role === 'freelancer')
                                <a href="{{ route('freelancer.profile', $recipient->id) }}"
                                    class="btn btn-ghost btn-sm gap-2 hover:bg-primary/10">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-5 h-5">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    <span class="hidden sm:inline">View
                                        Profile</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Chat Messages Area -->
                <div id="chat-box"
                    class="p-6 h-[500px] overflow-y-auto bg-linear-to-b from-base-200/30 to-base-100 space-y-4 scroll-smooth">
                    @foreach ($messages as $message)
                        @php
                            $isMine = $message->from_id == auth()->id();
                        @endphp

                        <div
                            class="message flex {{ $isMine ? 'justify-end' : 'justify-start' }} animate-fade-in">
                            <div
                                class="max-w-[75%] {{ $isMine ? 'items-end' : 'items-start' }} flex flex-col gap-1">
                                <!-- Sender Name -->
                                <span
                                    class="text-xs text-base-content/60 px-3 font-medium">
                                    {{ $isMine ? 'You' : $recipient->name }}
                                </span>

                                <!-- Message Bubble -->
                                <div class="group relative">
                                    <div
                                        class="px-4 py-3 rounded-2xl shadow-sm
                                        {{ $isMine
                                            ? 'bg-linear-to-br from-primary to-primary/90 text-primary-content rounded-br-sm'
                                            : 'bg-base-100 text-base-content border-2 border-base-200 rounded-bl-sm' }}">
                                        <p
                                            class="text-sm leading-relaxed wrap-break-word">
                                            {{ $message->message }}
                                        </p>
                                    </div>

                                    <!-- Timestamp & Status -->
                                    <div
                                        class="flex items-center gap-2 mt-1 px-3 {{ $isMine ? 'justify-end' : 'justify-start' }}">
                                        <span
                                            class="text-[10px] text-base-content/50">
                                            {{ $message->created_at->format('g:i A') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Message Input Area -->
                <div class="border-t-2 border-base-200 bg-base-100 p-4">
                    <div class="flex gap-3 items-end">
                        <!-- Text Input -->
                        <div class="flex-1">
                            <textarea id="message-input"
                                rows="1"
                                placeholder="Type your message..."
                                class="textarea textarea-bordered w-full resize-none focus:outline-none focus:border-primary transition-all duration-200 text-sm"
                                style="min-height: 44px; max-height: 120px;"></textarea>
                        </div>

                        <!-- Send Button -->
                        <button id="send-btn"
                            class="btn btn-primary btn-circle btn-lg shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="w-6 h-6">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                        </button>
                    </div>

                    <!-- Input Helper Text -->
                    {{-- <p class="text-xs text-base-content/50 mt-2 px-1">
                        Press Enter to send • Shift + Enter for new line
                    </p> --}}
                </div>
            </div>

            <!-- Typing Indicator (Hidden by default) -->
            <div id="typing-indicator"
                class="hidden mt-2 px-4">
                <div
                    class="flex items-center gap-2 text-sm text-base-content/60">
                    <div class="flex gap-1">
                        <span
                            class="w-2 h-2 bg-base-content/40 rounded-full animate-bounce"
                            style="animation-delay: 0ms;"></span>
                        <span
                            class="w-2 h-2 bg-base-content/40 rounded-full animate-bounce"
                            style="animation-delay: 150ms;"></span>
                        <span
                            class="w-2 h-2 bg-base-content/40 rounded-full animate-bounce"
                            style="animation-delay: 300ms;"></span>
                    </div>
                    <span>{{ $recipient->name }} is typing...</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.userId = {{ auth()->id() }};
        window.recipientId = {{ $recipient->id }};
        window.recipientName = "{{ $recipient->name }}";

        // Auto scroll to bottom on load
        const chatBox = document.getElementById("chat-box");
        chatBox.scrollTop = chatBox.scrollHeight;

        // Auto-resize textarea
        const textarea = document.getElementById('message-input');
        textarea.addEventListener('input', function() {
            this.style.height = '44px';
            this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        });

        // Handle Enter key (send) vs Shift+Enter (new line)
        textarea.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                document.getElementById('send-btn').click();
            }
        });
    </script>

    <style>
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

        /* Custom scrollbar */
        #chat-box::-webkit-scrollbar {
            width: 6px;
        }

        #chat-box::-webkit-scrollbar-track {
            background: transparent;
        }

        #chat-box::-webkit-scrollbar-thumb {
            background: hsl(var(--bc) / 0.2);
            border-radius: 10px;
        }

        #chat-box::-webkit-scrollbar-thumb:hover {
            background: hsl(var(--bc) / 0.3);
        }
    </style>

    @vite(['resources/js/chat.js'])
</x-layouts.app>
