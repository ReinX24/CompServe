<x-layouts.app>
    <div class="max-w-4xl mx-auto px-4 py-6">

        <!-- Page Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-primary">💬 Technical Support
                Assistant</h1>
            <p class="text-base-content/70 mt-1">
                Let’s try to fix your issue before posting a gig or a contract.
            </p>
        </div>

        <!-- Chat Card -->
        <div class="card bg-base-100 shadow-xl">

            <!-- Chat Body -->
            <div id="chat-container"
                class="card-body h-112 overflow-y-auto space-y-4 bg-base-200 rounded-t-xl">

                <!-- Initial Bot Message -->
                <div class="chat chat-start">
                    <div class="chat-image avatar">
                        <div
                            class="w-8 rounded-full bg-primary text-white flex items-center justify-center">
                            🤖
                        </div>
                    </div>
                    <div class="chat-bubble">
                        Hi! I'm here to help troubleshoot your technical issue.
                        Can you describe the problem you're experiencing?
                    </div>
                </div>
            </div>

            <!-- Input Area -->
            <div class="border-t border-base-300 p-4">
                <form id="chat-form"
                    class="flex gap-2">
                    <input type="text"
                        id="user-input"
                        placeholder="Describe your issue..."
                        class="input input-bordered w-full"
                        required>
                    <button type="submit"
                        id="send-btn"
                        class="btn btn-primary">
                        Send
                    </button>
                </form>

                <!-- Action Buttons -->
                <div id="action-buttons"
                    class="hidden mt-4 gap-2">
                    <a href="{{ route('client.jobs.create') }}"
                        class="btn btn-success flex-1">
                        📝 Post a Gig
                    </a>

                    <button id="restart-btn"
                        class="btn btn-outline flex-1">
                        🔄 Start New Conversation
                    </button>
                </div>
            </div>
        </div>

        <!-- Tips -->
        <div class="alert alert-warning mt-6 shadow">
            <div>
                <span class="text-lg">💡</span>
                <div>
                    <h3 class="font-bold">Tips for better assistance</h3>
                    <ul class="text-sm list-disc list-inside mt-1">
                        <li>Be specific about the problem</li>
                        <li>Mention any error messages</li>
                        <li>Describe what you already tried</li>
                        <li>Include device or OS if relevant</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    {{-- CSRF --}}
    <meta name="csrf-token"
        content="{{ csrf_token() }}">

    {{-- Chatbot Script --}}
    <script>
        let conversationHistory = [];
        let isProcessing = false;

        const chatContainer = document.getElementById('chat-container');
        const chatForm = document.getElementById('chat-form');
        const userInput = document.getElementById('user-input');
        const sendBtn = document.getElementById('send-btn');
        const actionButtons = document.getElementById('action-buttons');
        const restartBtn = document.getElementById('restart-btn');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        function addMessage(text, isUser = false) {
            const wrapper = document.createElement('div');
            wrapper.className = `chat ${isUser ? 'chat-end' : 'chat-start'}`;

            wrapper.innerHTML = `
                <div class="chat-image avatar">
                    <div class="w-8 rounded-full ${isUser ? 'bg-neutral text-white' : 'bg-primary text-white'}
                        flex items-center justify-center">
                        ${isUser ? '👤' : '🤖'}
                    </div>
                </div>
                <div class="chat-bubble ${isUser ? 'chat-bubble-neutral' : ''}">
                    ${text}
                </div>
            `;

            chatContainer.appendChild(wrapper);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        function showTypingIndicator() {
            const indicator = document.createElement('div');
            indicator.id = 'typing-indicator';
            indicator.className = 'chat chat-start';
            indicator.innerHTML = `
                <div class="chat-image avatar">
                    <div class="w-8 rounded-full bg-primary text-white flex items-center justify-center">
                        🤖
                    </div>
                </div>
                <div class="chat-bubble">
                    <span class="loading loading-dots loading-sm"></span>
                </div>
            `;
            chatContainer.appendChild(indicator);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        function removeTypingIndicator() {
            document.getElementById('typing-indicator')?.remove();
        }

        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            if (isProcessing) return;

            const message = userInput.value.trim();
            if (!message) return;

            isProcessing = true;
            userInput.disabled = true;
            sendBtn.disabled = true;

            addMessage(message, true);
            userInput.value = '';
            showTypingIndicator();

            try {
                const res = await fetch('{{ route('chatbot.chat') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        message,
                        conversation_history: conversationHistory
                    })
                });

                const data = await res.json();
                removeTypingIndicator();

                if (data.success) {
                    addMessage(data.message);
                    conversationHistory = data.conversation_history;

                    if (data.is_complete) {
                        actionButtons.classList.remove('hidden');
                    }
                } else {
                    addMessage(
                        'Something went wrong. Please try again.');
                }

            } catch (err) {
                removeTypingIndicator();
                addMessage('Connection error. Please try again.');
            } finally {
                if (actionButtons.classList.contains('hidden')) {
                    isProcessing = false;
                    userInput.disabled = false;
                    sendBtn.disabled = false;
                    userInput.focus();
                }
            }
        });

        restartBtn.addEventListener('click', () => {
            conversationHistory = [];
            chatContainer.innerHTML = '';
            actionButtons.classList.add('hidden');
            isProcessing = false;
            userInput.disabled = false;
            sendBtn.disabled = false;

            addMessage(
                "Hi! I'm here to help troubleshoot your technical issue. Can you describe the problem you're experiencing?"
            );
        });
    </script>
</x-layouts.app>
