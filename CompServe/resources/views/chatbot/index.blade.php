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

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(102, 126, 234, 0.4);
            }

            50% {
                box-shadow: 0 0 30px rgba(102, 126, 234, 0.6);
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

        /* Action button styling */
        .action-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            animation: slide-up 0.5s ease-out, pulse-glow 2s infinite;
        }

        .action-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(102, 126, 234, 0.4);
        }

        .action-button:active {
            transform: translateY(0);
        }

        .action-button-container {
            margin-top: 12px;
            animation: slide-up 0.5s ease-out;
        }
    </style>

    {{-- Chatbot Script --}}
    <script>
        const chatbotMode = "{{ $mode }}";

        let conversationHistory = [];
        let isProcessing = false;
        let messageCount = 1;
        let responseTimes = [];
        let currentReader = null; // Track current streaming reader

        // DOM Elements
        const chatContainer = document.getElementById('chat-container');
        const chatForm = document.getElementById('chat-form');
        const userInput = document.getElementById('user-input');
        const sendBtn = document.getElementById('send-btn');
        const sendText = document.getElementById('send-text');
        const actionButtons = document.getElementById('action-buttons');
        const restartBtn = document.getElementById('restart-btn');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')
            ?.content;
        const charCount = document.getElementById('char-count');
        const messageCountEl = document.getElementById('message-count');
        const messageCountHeader = document.getElementById('message-count-header');
        const avgResponseEl = document.getElementById('avg-response');
        const avgResponseHeader = document.getElementById('avg-response-header');

        // Validate critical elements exist
        if (!csrfToken) {
            console.error('CSRF token not found');
        }

        // Character counter
        if (userInput && charCount) {
            userInput.addEventListener('input', () => {
                charCount.textContent = userInput.value.length;
            });
        }

        // Quick message function
        window.setQuickMessage = function(message) {
            if (userInput) {
                userInput.value = message;
                userInput.focus();
            }
        };

        function updateMessageCount(count) {
            if (messageCountEl) messageCountEl.textContent = count;
            if (messageCountHeader) messageCountHeader.textContent = count;
        }

        function updateAvgResponse(time) {
            const avgText = `~${time}s`;
            if (avgResponseEl) avgResponseEl.textContent = avgText;
            if (avgResponseHeader) avgResponseHeader.textContent = avgText;
        }

        function addMessage(text, isUser = false, isStreaming = false, action =
            null) {
            if (!chatContainer) return null;

            const wrapper = document.createElement('div');
            wrapper.className =
                `chat ${isUser ? 'chat-end' : 'chat-start'} animate-slide-in`;

            const timestamp = new Date().toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit'
            });

            const actionButtonHtml = action ? `
            <div class="action-button-container">
                <a href="${action.url}" class="action-button">
                    <span style="font-size: 1.25rem;">${action.icon}</span>
                    <span>${action.label}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        ` : '';

            wrapper.innerHTML = `
            <div class="chat-image avatar">
                <div class="w-10 rounded-full ${isUser ? 'bg-neutral text-white' : 'bg-primary text-white'}
                    flex items-center justify-center shadow-lg">
                    ${isUser ? '👤' : '🤖'}
                </div>
            </div>
            <div>
                <div class="chat-bubble ${isUser ? 'chat-bubble-neutral' : 'chat-bubble-primary'} shadow-md ${isStreaming ? 'streaming-message' : ''}">
                    ${text}${isStreaming ? '<span class="typing-cursor"></span>' : ''}
                </div>
                ${actionButtonHtml}
            </div>
            <div class="chat-footer opacity-50 text-xs mt-1">
                ${timestamp}
            </div>
        `;

            chatContainer.appendChild(wrapper);
            chatContainer.scrollTop = chatContainer.scrollHeight;

            if (!isUser) {
                messageCount++;
                updateMessageCount(messageCount);
            }

            return wrapper;
        }

        function updateStreamingMessage(wrapper, text) {
            if (!wrapper) return;
            const bubble = wrapper.querySelector('.chat-bubble');
            if (bubble) {
                bubble.innerHTML = text + '<span class="typing-cursor"></span>';
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
        }

        function finalizeStreamingMessage(wrapper, text, action = null) {
            if (!wrapper) return;

            const bubble = wrapper.querySelector('.chat-bubble');
            if (bubble) {
                bubble.innerHTML = text;
                bubble.classList.remove('streaming-message');
            }

            // Add action button if provided
            if (action) {
                const actionContainer = document.createElement('div');
                actionContainer.className = 'action-button-container';
                actionContainer.innerHTML = `
                <a href="${action.url}" class="action-button">
                    <span style="font-size: 1.25rem;">${action.icon}</span>
                    <span>${action.label}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            `;
                const parent = bubble.parentElement;
                if (parent) {
                    parent.appendChild(actionContainer);
                }
            }
        }

        function showTypingIndicator() {
            if (!chatContainer) return;

            // Remove existing indicator if any
            removeTypingIndicator();

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
            const indicator = document.getElementById('typing-indicator');
            if (indicator) {
                indicator.remove();
            }
        }

        function setButtonLoading(loading) {
            if (!sendBtn || !sendText) return;

            if (loading) {
                sendBtn.classList.add('loading');
                sendText.textContent = 'Sending...';
                sendBtn.disabled = true;
            } else {
                sendBtn.classList.remove('loading');
                sendText.textContent = 'Send';
                sendBtn.disabled = false;
            }
        }

        function resetInputState() {
            isProcessing = false;
            if (userInput) {
                userInput.disabled = false;
                userInput.focus();
            }
            setButtonLoading(false);
        }

        function disableInput() {
            isProcessing = true;
            if (userInput) userInput.disabled = true;
            if (sendBtn) sendBtn.disabled = true;
            setButtonLoading(true);
        }

        // Cleanup function for streaming
        function cleanupStreaming() {
            if (currentReader) {
                try {
                    currentReader.cancel();
                } catch (e) {
                    console.error('Error canceling reader:', e);
                }
                currentReader = null;
            }
            removeTypingIndicator();
        }

        if (chatForm) {
            chatForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                if (isProcessing) {
                    console.log('Already processing a message');
                    return;
                }

                if (!userInput) return;

                const message = userInput.value.trim();
                if (!message) return;

                const startTime = Date.now();
                disableInput();

                addMessage(message, true);
                userInput.value = '';
                if (charCount) charCount.textContent = '0';

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

                    if (!response.ok) {
                        throw new Error(
                            `Server error: ${response.status} ${response.statusText}`
                        );
                    }

                    // Check if response is JSON (direct action) or stream
                    const contentType = response.headers.get(
                        'content-type');

                    if (contentType && contentType.includes(
                            'application/json')) {
                        // Handle direct action response (non-streaming)
                        const data = await response.json();

                        if (data.success) {
                            addMessage(data.message, false, false, data
                                .action);
                            conversationHistory = data
                                .conversation_history;

                            if (data.is_complete) {
                                if (actionButtons) actionButtons
                                    .classList.remove('hidden');
                                if (userInput) userInput.disabled =
                                    true;
                                if (sendBtn) sendBtn.disabled = true;
                            }
                        } else {
                            addMessage(data.message ||
                                'An error occurred. Please try again.'
                            );
                        }
                    } else {
                        // Handle streaming response
                        showTypingIndicator();

                        const reader = response.body.getReader();
                        currentReader = reader;
                        const decoder = new TextDecoder();
                        let fullText = '';
                        let messageWrapper = null;

                        try {
                            while (true) {
                                const {
                                    done,
                                    value
                                } = await reader.read();
                                if (done) break;

                                const chunk = decoder.decode(value, {
                                    stream: true
                                });
                                const lines = chunk.split('\n');

                                for (const line of lines) {
                                    if (line.startsWith('data: ')) {
                                        try {
                                            const data = JSON.parse(line
                                                .slice(6));

                                            if (data.error) {
                                                removeTypingIndicator();
                                                addMessage(data
                                                    .message ||
                                                    'An error occurred while generating response.'
                                                );
                                                break;
                                            }

                                            if (!data.done) {
                                                fullText += data.chunk;

                                                if (!messageWrapper) {
                                                    removeTypingIndicator
                                                        ();
                                                    messageWrapper =
                                                        addMessage(
                                                            fullText,
                                                            false, true
                                                        );
                                                } else {
                                                    updateStreamingMessage
                                                        (messageWrapper,
                                                            fullText);
                                                }
                                            } else {
                                                // Finalize message
                                                if (messageWrapper) {
                                                    finalizeStreamingMessage
                                                        (messageWrapper,
                                                            data
                                                            .full_text,
                                                            data.action
                                                        );
                                                }

                                                conversationHistory =
                                                    data
                                                    .conversation_history;

                                                if (data.is_complete) {
                                                    if (actionButtons)
                                                        actionButtons
                                                        .classList
                                                        .remove(
                                                            'hidden');
                                                    if (userInput)
                                                        userInput
                                                        .disabled =
                                                        true;
                                                    if (sendBtn) sendBtn
                                                        .disabled =
                                                        true;
                                                }

                                                // Update response time
                                                const responseTime = ((
                                                        Date.now() -
                                                        startTime) /
                                                    1000).toFixed(1);
                                                responseTimes.push(
                                                    parseFloat(
                                                        responseTime
                                                    ));
                                                const avgTime = (
                                                        responseTimes
                                                        .reduce((a,
                                                                b) =>
                                                            a + b,
                                                            0) /
                                                        responseTimes
                                                        .length)
                                                    .toFixed(1);
                                                updateAvgResponse(
                                                    avgTime);
                                            }
                                        } catch (parseError) {
                                            console.error(
                                                'Error parsing stream data:',
                                                parseError, 'Line:',
                                                line);
                                        }
                                    }
                                }
                            }
                        } finally {
                            currentReader = null;
                        }
                    }

                } catch (err) {
                    cleanupStreaming();
                    addMessage(
                        'Connection error. Please check your internet connection and try again.'
                    );
                    console.error('Fetch error:', err);
                } finally {
                    if (actionButtons && !actionButtons.classList
                        .contains('hidden')) {
                        // Conversation is complete, keep input disabled
                        isProcessing = false;
                        setButtonLoading(false);
                    } else {
                        // Normal message, re-enable input
                        resetInputState();
                    }
                }
            });
        }

        if (restartBtn) {
            restartBtn.addEventListener('click', () => {
                // Cleanup any ongoing streaming
                cleanupStreaming();

                // Reset state
                conversationHistory = [];
                if (chatContainer) chatContainer.innerHTML = '';
                if (actionButtons) actionButtons.classList.add('hidden');
                isProcessing = false;
                if (userInput) {
                    userInput.disabled = false;
                    userInput.value = '';
                }
                if (sendBtn) sendBtn.disabled = false;
                setButtonLoading(false);
                messageCount = 1;
                updateMessageCount(messageCount);
                responseTimes = [];
                updateAvgResponse('2');

                // Add appropriate greeting based on mode
                const greetingMessage = chatbotMode === 'client' ?
                    "Hi! I'm here to help troubleshoot your technical issue. Can you describe the problem you're experiencing?" :
                    "Hi! I'm here to help you find the perfect gigs and contracts that match your skills. What kind of work are you looking for?";

                addMessage(greetingMessage);
                if (userInput) userInput.focus();
            });
        }

        // Cleanup on page unload
        window.addEventListener('beforeunload', () => {
            cleanupStreaming();
        });

        // Auto-focus input on load
        if (userInput) userInput.focus();
    </script>
</x-layouts.app>
