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
    // Helper: append message to chat
    // -------------------------------
    function appendMessage(message, isMine, readAt = null) {
        const wrapper = document.createElement('div');
        wrapper.className = `message ${isMine ? 'from-me text-right' : 'from-them text-left'}`;

        const status = isMine
            ? `<div class="text-[10px] opacity-60 mt-1">${readAt ? '✓ Read' : '✓ Sent'}</div>`
            : '';

        wrapper.innerHTML = `
            <div class="inline-block px-3 py-2 rounded-lg ${
                isMine
                    ? 'bg-primary text-primary-content'
                    : 'bg-secondary text-secondary-content'
            }">
                <strong class="block text-xs opacity-80">
                    ${isMine ? 'Me' : recipientName}
                </strong>
                ${message}
                ${status}
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
    }

    // send button click
    if (sendBtn) {
        sendBtn.addEventListener('click', () => {
            const msg = messageInput.value;
            if (!msg.trim()) return;
            sendMessage(recipientId, msg);
        });
    }

    // enter key to send
    if (messageInput) {
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendBtn.click();
        });
    }

    // auto-scroll on load
    if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;

    window.sendMessage = sendMessage;
});
