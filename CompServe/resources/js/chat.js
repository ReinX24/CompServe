document.addEventListener('DOMContentLoaded', () => {
    const chatBox = document.getElementById('chat-box');
    const messageInput = document.getElementById('message-input');
    const sendBtn = document.getElementById('send-btn');

    if (!window.Echo) {
        console.error('Echo not initialized!');
        return;
    }

    const userId = window.userId; // current user
    const recipientId = window.recipientId;
    const recipientName = window.recipientName;

    if (!userId || !recipientId || !recipientName) {
        console.error('User ID, Recipient ID, or Name missing.');
        return;
    }

    // ========================================
    // JOIN PRESENCE CHANNEL (Stay online!)
    // ========================================
    Echo.join('presence.online')
        .here((users) => {
            console.log('Currently online users:', users);
        })
        .joining((user) => {
            console.log('User joined:', user);
        })
        .leaving((user) => {
            console.log('User left:', user);
        })
        .error((error) => {
            console.error('Presence error:', error);
        });

    // -------------------------------
    // Helper: append message to chat (UPDATED TO MATCH BLADE STYLING)
    // -------------------------------
    function appendMessage(message, isMine, readAt = null) {
        const wrapper = document.createElement('div');
        wrapper.className = `message flex ${isMine ? 'justify-end' : 'justify-start'} animate-fade-in`;

        const currentTime = new Date().toLocaleTimeString('en-US', {
            hour: 'numeric',
            minute: '2-digit',
            hour12: true,
        });

        wrapper.innerHTML = `
            <div class="max-w-[75%] ${isMine ? 'items-end' : 'items-start'} flex flex-col gap-1">
                <!-- Sender Name -->
                <span class="text-xs text-base-content/60 px-3 font-medium">
                    ${isMine ? 'You' : recipientName}
                </span>

                <!-- Message Bubble -->
                <div class="group relative">
                    <div class="px-4 py-3 rounded-2xl shadow-sm ${
                        isMine
                            ? 'bg-linear-to-br from-primary to-primary/90 text-primary-content rounded-br-sm'
                            : 'bg-base-100 text-base-content border-2 border-base-200 rounded-bl-sm'
                    }">
                        <p class="text-sm leading-relaxed wrap-break-word">
                            ${message}
                        </p>
                    </div>

                    <!-- Timestamp & Status -->
                    <div class="flex items-center gap-2 mt-1 px-3 ${isMine ? 'justify-end' : 'justify-start'}">
                        <span class="text-[10px] text-base-content/50">
                            ${currentTime}
                        </span>
                    </div>
                </div>
            </div>
        `;

        chatBox.appendChild(wrapper);
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    // -------------------------------
    // Incoming messages (real-time)
    // -------------------------------
    window.Echo.private(`chat.${userId}`).listen('.MessageSent', async (e) => {
        // Only show if message belongs to this chat thread
        if (e.message.from_id !== recipientId) return;

        appendMessage(e.message.message, false);

        // Mark as read in backend
        try {
            await fetch('/chat/read', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector(
                        'meta[name="csrf-token"]',
                    ).content,
                },
                body: JSON.stringify({ message_id: e.message.id }),
            });
        } catch (err) {
            console.error('Read receipt error:', err);
        }

        console.log('Message received:', e.message);
    });

    // -------------------------------
    // Send message
    // -------------------------------
    async function sendMessage(to_id, message) {
        if (!message.trim()) return;

        // Add visually immediately
        appendMessage(message, true, false);

        try {
            const res = await fetch('/chat/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector(
                        'meta[name="csrf-token"]',
                    ).content,
                },
                body: JSON.stringify({ to_id, message }),
            });

            const sentMessage = await res.json();

            // Update "✓ Sent" status — nothing more needed until read
            console.log('Sent message:', sentMessage);
        } catch (err) {
            console.error('Send message error:', err);
        }

        messageInput.value = '';

        // Reset textarea height after sending
        messageInput.style.height = '44px';
    }

    // send button click
    if (sendBtn) {
        sendBtn.addEventListener('click', () => {
            const msg = messageInput.value;
            if (!msg.trim()) return;
            sendMessage(recipientId, msg);
        });
    }

    // enter key to send (already handled in blade template, but keeping for compatibility)
    if (messageInput) {
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendBtn.click();
            }
        });
    }

    // auto-scroll on load
    if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;

    window.sendMessage = sendMessage;
});
