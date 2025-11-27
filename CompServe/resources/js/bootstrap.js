import axios from 'axios';
import Alpine from 'alpinejs';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Alpine = Alpine;

Alpine.start();

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher; // Make Pusher globally available

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '673b4a60bd1c90829f13',
    cluster: 'ap1',
    forceTLS: true,
});
