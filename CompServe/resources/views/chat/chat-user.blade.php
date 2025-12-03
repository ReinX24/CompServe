<x-layouts.app>

    <div class="max-w-3xl mx-auto py-6">

        <h2 class="text-2xl font-bold mb-4">
            Chat with <span class="text-primary">{{ $recipient->name }}</span>
        </h2>

        <!-- Chat Box -->
        <div id="chat-box"
            class="p-4 h-[450px] overflow-y-auto rounded-box bg-base-200 shadow-inner space-y-4">

            @foreach ($messages as $message)
                <div
                    class="message {{ $message->from_id == auth()->id() ? 'text-right' : 'text-left' }}">
                    <div
                        class="inline-block px-4 py-2 rounded-xl
                        {{ $message->from_id == auth()->id()
                            ? 'bg-primary text-primary-content'
                            : 'bg-secondary text-secondary-content' }}">

                        <strong class="block text-xs opacity-80 mb-1">
                            {{ $message->from_id == auth()->id() ? 'Me' : $recipient->name }}
                        </strong>

                        {{ $message->message }}

                        @if ($message->from_id == auth()->id())
                            <div class="text-[10px] opacity-70 mt-1">
                                {{ $message->read_at ? '✓ Read' : '✓ Sent' }}
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

        </div>

        <!-- Input & Button -->
        <div class="mt-4 flex gap-2">
            <input id="message-input"
                type="text"
                placeholder="Type a message..."
                class="input input-bordered w-full" />
            <button id="send-btn"
                class="btn btn-primary">Send</button>
        </div>

    </div>

    <script>
        window.userId = {{ auth()->id() }};
        window.recipientId = {{ $recipient->id }};
        window.recipientName = "{{ $recipient->name }}";

        // Auto scroll to bottom on load
        const chatBox = document.getElementById("chat-box");
        chatBox.scrollTop = chatBox.scrollHeight;
    </script>

    @vite(['resources/js/chat.js'])
</x-layouts.app>
