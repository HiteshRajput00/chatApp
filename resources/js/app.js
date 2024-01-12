import './bootstrap';
import Echo from "laravel-echo";
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '6a4779b6347a42b898b0',
    cluster: 'ap2',
    encrypted: true,
});