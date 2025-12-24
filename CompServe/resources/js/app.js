import './bootstrap';

// var channel = Echo.channel('my-channel');

// channel.listen('.my-event', function (data) {
//     alert(JSON.stringify(data));
// });

// TODO: debug this to show user is online from all pages
// Added this so that it shows if the current user is online or not
// if (window.Echo && window.authId) {
//     Echo.join('presence.online')
//         .here((users) => {
//             console.log('Online users:', users);
//             users.forEach((u) => markOnline(u.id));
//         })
//         .joining((user) => {
//             console.log('User joined:', user);
//             markOnline(user.id);
//         })
//         .leaving((user) => {
//             console.log('User left:', user);
//             markOffline(user.id);
//         })
//         .error((error) => {
//             console.error('Presence error:', error);
//         });

//     function markOnline(userId) {
//         const dot = document.querySelector(`#user-status-${userId}`);
//         if (dot) dot.classList.replace('bg-gray-400', 'bg-green-500');
//     }

//     function markOffline(userId) {
//         const dot = document.querySelector(`#user-status-${userId}`);
//         if (dot) dot.classList.replace('bg-green-500', 'bg-gray-400');
//     }
// }