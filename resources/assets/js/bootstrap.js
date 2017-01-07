import Echo from "laravel-echo"

// window.Echo = new Echo({
//     cluster: 'mt1',
//     broadcaster: 'pusher',
//     key: '321d89618ec4a140cbca',
//     encrypted: true
// });

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: 'localhost:3000',
});
