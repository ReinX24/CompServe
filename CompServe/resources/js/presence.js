// resources/js/presence.js
if (window.Echo && window.authId) {
    Echo.join('presence.online')
        .here((users) => {
            console.log('Online users:', users);
            users.forEach((u) => markOnline(u.id));
        })
        .joining((user) => {
            console.log('User joined:', user);
            markOnline(user.id);
        })
        .leaving((user) => {
            console.log('User left:', user);
            markOffline(user.id);
        })
        .error((error) => {
            console.error('Presence error:', error);
        });

    function markOnline(userId) {
        const dot = document.querySelector(`#user-status-${userId}`);
        if (dot) dot.classList.replace('bg-gray-400', 'bg-green-500');
    }

    function markOffline(userId) {
        const dot = document.querySelector(`#user-status-${userId}`);
        if (dot) dot.classList.replace('bg-green-500', 'bg-gray-400');
    }
}
