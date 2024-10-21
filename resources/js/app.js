import './bootstrap';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

const userId = window.Laravel.user.id;
const userRole = window.Laravel.user.role;

if (userId && userRole == 3) { // Only listen if the user is a candidate
    window.Echo.private(`App.Models.User.${userId}`)
        .notification((notification) => {
            console.log(notification);
            alert(`Your application status has been updated to: ${notification.status}`);  // Replace with custom notification handling
        });
}
