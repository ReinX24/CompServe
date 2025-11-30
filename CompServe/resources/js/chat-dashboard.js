document.addEventListener('DOMContentLoaded', () => {
    const authId = window.authId;

    if (!window.Echo) return;

    const searchInput = document.getElementById('user-search');
    const resultsList = document.getElementById('search-results');

    // === SEARCH USERS ===
    if (searchInput && resultsList) {
        searchInput.addEventListener('input', async () => {
            const query = searchInput.value.trim();

            if (!query) {
                resultsList.classList.add('hidden');
                resultsList.innerHTML = '';
                return;
            }

            try {
                const res = await fetch(
                    `/users/search?q=${encodeURIComponent(query)}`,
                );
                const users = await res.json();

                resultsList.innerHTML = users
                    .map(
                        (user) => `
                        <li data-id="${user.id}" class="px-4 py-2 hover:bg-base-200 cursor-pointer flex justify-between items-center">
                            <span>${user.name}</span>
                        </li>
                    `,
                    )
                    .join('');

                resultsList.classList.remove('hidden');
            } catch (err) {
                console.error(err);
            }
        });

        resultsList.addEventListener('click', (e) => {
            const li = e.target.closest('li');
            if (!li) return;

            const userId = li.dataset.id;
            window.location.href = `/chat/${userId}`;
        });

        document.addEventListener('click', (e) => {
            if (
                !searchInput.contains(e.target) &&
                !resultsList.contains(e.target)
            ) {
                resultsList.classList.add('hidden');
            }
        });
    }

    // === REALTIME MESSAGE UPDATES ===
    Echo.private(`chat.${authId}`).listen('.MessageSent', (event) => {
        const message = event.message;

        // Determine the "other user" in this conversation
        const otherUserId =
            message.sender.id === authId
                ? message.receiver.id
                : message.sender.id;
        const otherUserName =
            message.sender.id === authId
                ? message.receiver.name
                : message.sender.name;

        console.log('Message received:', {
            otherUserId,
            otherUserName,
            message,
        });

        // Update the dashboard: if this is a new sender, create a new conversation item
        updateConversationPreview(otherUserId, message, otherUserName);
    });

    function updateConversationPreview(userId, message, userName) {
        let li = document.querySelector(`#conversation-${userId}`);

        // If this is a NEW conversation → create a new list item
        if (!li) {
            console.log('Creating new conversation for user:', userId);
            createNewConversationItem(userId, message, userName);
            return;
        }

        // Update existing conversation
        const preview = li.querySelector('.convo-preview');
        const badge = li.querySelector('.unread-count');
        const time = li.querySelector('.convo-time');

        if (preview) {
            preview.textContent = message.message;
        }

        // Only increase badge if the message is from the other user
        if (message.sender.id !== authId && badge) {
            badge.classList.remove('hidden');
            const currentCount = parseInt(badge.textContent || 0);
            badge.textContent = currentCount + 1;
        }

        if (time) {
            time.textContent = 'Just now';
        }

        // Move conversation to top
        if (li.parentElement) {
            li.parentElement.prepend(li);
        }
    }

    function createNewConversationItem(userId, message, userName) {
        // More specific selector for the conversations list
        const ul =
            document.querySelector('.overflow-x-auto ul.menu') ||
            document.querySelector('ul.menu.bg-base-100') ||
            document.querySelector('#conversations-list');

        console.log('Attempting to create conversation...', {
            ul: ul,
            ulFound: !!ul,
            userId: userId,
            userName: userName,
            totalMenus: document.querySelectorAll('ul.menu').length,
        });

        if (!ul) {
            console.error('❌ Menu list (ul.menu) not found in DOM!');
            return;
        }

        // Generate initials safely
        const initials = userName
            ? userName
                  .split(' ')
                  .filter((n) => n.length > 0)
                  .map((n) => n[0])
                  .join('')
                  .toUpperCase()
                  .substring(0, 2) // Limit to 2 characters
            : '??';

        const li = document.createElement('li');
        li.id = `conversation-${userId}`;
        li.dataset.userId = userId;

        // Determine if we should show the unread badge
        const isFromOther = message.sender.id !== authId;
        const unreadClass = isFromOther ? '' : 'hidden';
        const unreadCount = isFromOther ? 1 : 0;

        li.innerHTML = `
            <a href="/chat/${userId}" class="flex items-center justify-between p-4 bg-base-200 hover:bg-base-300 text-neutral rounded-lg transition">
                <div class="flex items-center gap-4">
                    <div class="avatar relative">
                        <div class="w-12 h-12 rounded-full bg-primary text-primary-content flex items-center justify-center font-bold text-lg">
                            ${initials}
                        </div>
                        <span id="user-status-${userId}" class="absolute bottom-0 right-0 w-3 h-3 rounded-full bg-gray-400 border-2 border-base-100"></span>
                    </div>
                    <div>
                        <p class="font-semibold convo-name">${userName || 'Unknown User'}</p>
                        <p class="text-sm truncate w-64 convo-preview">${message.message}</p>
                    </div>
                </div>
                <div class="flex flex-col items-end gap-1">
                    <span class="badge badge-error unread-count ${unreadClass}">${unreadCount}</span>
                    <span class="text-xs text-gray-400 convo-time">Just now</span>
                </div>
            </a>
        `;

        console.log('✅ Li element created:', li);
        console.log('Prepending to ul...');

        ul.prepend(li);

        console.log('✅ New conversation item added to DOM for user:', userId);
        console.log('Total conversations now:', ul.children.length);

        // Force a reflow to ensure the element is rendered
        li.offsetHeight;
    }

    // === ONLINE STATUS ===
    Echo.join('presence.online')
        .here((users) => {
            users.forEach((u) => markOnline(u.id));
        })
        .joining((user) => {
            markOnline(user.id);
        })
        .leaving((user) => {
            markOffline(user.id);
        });

    function markOnline(userId) {
        const dot = document.querySelector(`#user-status-${userId}`);
        if (dot) dot.classList.replace('bg-gray-400', 'bg-green-500');
    }

    function markOffline(userId) {
        const dot = document.querySelector(`#user-status-${userId}`);
        if (dot) dot.classList.replace('bg-green-500', 'bg-gray-400');
    }
});
