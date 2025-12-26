<x-layouts.app>
    <div
        class="min-h-screen bg-linear-to-br from-gray-50 via-blue-50 to-purple-50 dark:from-base-300 dark:via-base-200 dark:to-base-100 py-8">
        <div class="max-w-7xl mx-auto px-4">

            <!-- PREMIUM HEADER -->
            @include('chatbot.partials.header')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- CHAT AREA -->
                @include('chatbot.partials.chat-area')

                <!-- SIDEBAR -->
                @include('chatbot.partials.sidebar')
            </div>
        </div>
    </div>

    {{-- CSRF --}}
    <meta name="csrf-token"
        content="{{ csrf_token() }}">

    <style>
        @keyframes slide-in {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-in {
            animation: slide-in 0.3s ease-out;
        }

        .animate-slide-up {
            animation: slide-up 0.3s ease-out;
        }

        #chat-container::-webkit-scrollbar {
            width: 8px;
        }

        #chat-container::-webkit-scrollbar-track {
            background: transparent;
        }

        #chat-container::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 4px;
        }

        #chat-container::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }

        .chat-bubble {
            animation: slide-in 0.3s ease-out;
        }

        .typing-cursor {
            display: inline-block;
            width: 2px;
            height: 1em;
            background: currentColor;
            animation: blink 1s infinite;
            margin-left: 2px;
        }

        @keyframes blink {

            0%,
            50% {
                opacity: 1;
            }

            51%,
            100% {
                opacity: 0;
            }
        }

        /* User message styling */
        .chat-end .chat-bubble {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .chat-end .chat-image>div {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>

    {{-- Chatbot Script --}}
    <script>
        const chatbotMode = "{{ $mode }}";

        let conversationHistory = [];
        let isProcessing = false;
        let messageCount = 1;
        let responseTimes = [];

        const chatContainer = document.getElementById('chat-container');
        const chatForm = document.getElementById('chat-form');
        const userInput = document.getElementById('user-input');
        const sendBtn = document.getElementById('send-btn');
        const sendText = document.getElementById('send-text');
        const actionButtons = document.getElementById('action-buttons');
        const restartBtn = document.getElementById('restart-btn');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        const charCount = document.getElementById('char-count');
        const messageCountEl = document.getElementById('message-count');

        // Character counter
        userInput.addEventListener('input', () => {
            charCount.textContent = userInput.value.length;
        });

        // Quick message function
        window.setQuickMessage = function(message) {
            userInput.value = message;
            userInput.focus();
        };

        function addMessage(text, isUser = false, isStreaming = false) {
            const wrapper = document.createElement('div');
            wrapper.className =
                `chat ${isUser ? 'chat-end' : 'chat-start'} animate-slide-in`;

            const timestamp = new Date().toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit'
            });

            wrapper.innerHTML = `
                <div class="chat-image avatar">
                    <div class="w-10 rounded-full ${isUser ? 'bg-neutral text-white' : 'bg-primary text-white'}
                        flex items-center justify-center shadow-lg">
                        ${isUser ? '👤' : '🤖'}
                    </div>
                </div>
                <div class="chat-bubble ${isUser ? 'chat-bubble-neutral' : 'chat-bubble-primary'} shadow-md ${isStreaming ? 'streaming-message' : ''}">
                    ${text}${isStreaming ? '<span class="typing-cursor"></span>' : ''}
                </div>
                <div class="chat-footer opacity-50 text-xs mt-1">
                    ${timestamp}
                </div>
            `;

            chatContainer.appendChild(wrapper);
            chatContainer.scrollTop = chatContainer.scrollHeight;

            if (!isUser) {
                messageCount++;
                messageCountEl.textContent = messageCount;
            }

            return wrapper;
        }

        function updateStreamingMessage(wrapper, text) {
            const bubble = wrapper.querySelector('.chat-bubble');
            bubble.innerHTML = text + '<span class="typing-cursor"></span>';
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        function finalizeStreamingMessage(wrapper, text) {
            const bubble = wrapper.querySelector('.chat-bubble');
            bubble.innerHTML = text;
            bubble.classList.remove('streaming-message');
        }

        function showTypingIndicator() {
            const indicator = document.createElement('div');
            indicator.id = 'typing-indicator';
            indicator.className = 'chat chat-start animate-slide-in';
            indicator.innerHTML = `
                <div class="chat-image avatar">
                    <div class="w-10 rounded-full bg-primary text-white flex items-center justify-center shadow-lg">
                        🤖
                    </div>
                </div>
                <div class="chat-bubble chat-bubble-primary shadow-md">
                    <span class="loading loading-dots loading-sm"></span>
                </div>
            `;
            chatContainer.appendChild(indicator);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        function removeTypingIndicator() {
            document.getElementById('typing-indicator')?.remove();
        }

        function setButtonLoading(loading) {
            if (loading) {
                sendBtn.classList.add('loading');
                sendText.textContent = 'Sending...';
            } else {
                sendBtn.classList.remove('loading');
                sendText.textContent = 'Send';
            }
        }

        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            if (isProcessing) return;

            const message = userInput.value.trim();
            if (!message) return;

            const startTime = Date.now();
            isProcessing = true;
            userInput.disabled = true;
            sendBtn.disabled = true;
            setButtonLoading(true);

            addMessage(message, true);
            userInput.value = '';
            charCount.textContent = '0';

            showTypingIndicator();

            try {
                const response = await fetch(
                    '{{ route('chatbot.chat') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'text/event-stream'
                        },
                        body: JSON.stringify({
                            message,
                            conversation_history: conversationHistory,
                            mode: chatbotMode
                        })
                    });

                removeTypingIndicator();

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const reader = response.body.getReader();
                const decoder = new TextDecoder();
                let fullText = '';
                let messageWrapper = null;

                while (true) {
                    const {
                        done,
                        value
                    } = await reader.read();
                    if (done) break;

                    const chunk = decoder.decode(value);
                    const lines = chunk.split('\n');

                    for (const line of lines) {
                        if (line.startsWith('data: ')) {
                            const data = JSON.parse(line.slice(6));

                            if (!data.done) {
                                fullText += data.chunk;

                                if (!messageWrapper) {
                                    messageWrapper = addMessage(
                                        fullText, false, true);
                                } else {
                                    updateStreamingMessage(
                                        messageWrapper, fullText);
                                }
                            } else {
                                // Finalize message
                                if (messageWrapper) {
                                    finalizeStreamingMessage(
                                        messageWrapper, data
                                        .full_text);
                                }

                                conversationHistory = data
                                    .conversation_history;

                                if (data.is_complete) {
                                    actionButtons.classList.remove(
                                        'hidden');
                                    userInput.disabled = true;
                                    sendBtn.disabled = true;
                                }

                                // Update response time
                                const responseTime = ((Date.now() -
                                    startTime) / 1000).toFixed(1);
                                responseTimes.push(parseFloat(
                                    responseTime));
                                const avgTime = (responseTimes.reduce((
                                        a, b) => a + b, 0) /
                                    responseTimes.length).toFixed(1);
                                document.getElementById('avg-response')
                                    .textContent = `~${avgTime}s`;
                            }
                        }
                    }
                }

            } catch (err) {
                removeTypingIndicator();
                addMessage(
                    'Connection error. Please try again. Error: ' +
                    err.message);
                console.error('Fetch error:', err);
            } finally {
                if (actionButtons.classList.contains('hidden')) {
                    isProcessing = false;
                    userInput.disabled = false;
                    sendBtn.disabled = false;
                    setButtonLoading(false);
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
            setButtonLoading(false);
            messageCount = 1;
            messageCountEl.textContent = messageCount;
            responseTimes = [];
            document.getElementById('avg-response').textContent = '~2s';

            addMessage(
                "Hi! I'm here to help troubleshoot your technical issue. Can you describe the problem you're experiencing?"
            );
            userInput.focus();
        });

        // Auto-focus input on load
        userInput.focus();
    </script>
</x-layouts.app>
