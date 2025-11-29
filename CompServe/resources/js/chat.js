// import './bootstrap';

// // Logged-in user ID from Blade
// const userId = window.userId;

// window.Echo.private(`chat.${userId}`).listen('.MessageSent', (e) => {
//     console.log('New message received:', e.message);

//     const log = document.getElementById('log');
//     if (log) {
//         log.innerHTML += `<p><strong>User ${e.message.from_id}:</strong> ${e.message.message}</p>`;
//     }
// });

// function sendMessage(to_id, message) {
//     console.log(message);

//     fetch('/send-message', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
//                 .content,
//         },
//         body: JSON.stringify({ to_id, message }),
//     });
// }

// window.sendMessage = sendMessage;

import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const chatBox = document.getElementById('chat-box');
    const messageInput = document.getElementById('message-input');
    const sendBtn = document.getElementById('send-btn');

    if (!window.Echo) {
        console.error('Echo not initialized!');
        return;
    }

    const userId = window.userId; // Current logged-in user
    const recipientId = window.recipientId; // Recipient ID
    const recipientName = window.recipientName; // Recipient name

    if (!userId || !recipientId || !recipientName) {
        console.error(
            'User ID, Recipient ID, or Recipient Name not set on window object.',
        );
        return;
    }

    // Listen for incoming messages
    window.Echo.private(`chat.${userId}`).listen('.MessageSent', (e) => {
        if (chatBox) {
            const alignment =
                e.message.from_id === userId ? 'from-me' : 'from-them';
            const sender = e.message.from_id === userId ? 'Me' : recipientName;
            chatBox.innerHTML += `<div class="message ${alignment}"><strong>${sender}:</strong> ${e.message.message}</div>`;
            chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll
        }
        console.log('Message received:', e.message);
    });

    function sendMessage(to_id, message) {
        if (!message.trim()) return;
        fetch('/chat/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
            },
            body: JSON.stringify({ to_id, message }),
        });
        messageInput.value = ''; // Clear input
    }

    if (sendBtn) {
        sendBtn.addEventListener('click', () => {
            const message = messageInput.value;

            if (!message.trim()) return;

            // Append sender message immediately
            chatBox.innerHTML += `<div class="message from-me"><strong>Me:</strong> ${message}</div>`;
            chatBox.scrollTop = chatBox.scrollHeight;

            sendMessage(recipientId, message);
        });
    }

    if (messageInput) {
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendBtn.click();
        });
    }

    window.sendMessage = sendMessage;
});
