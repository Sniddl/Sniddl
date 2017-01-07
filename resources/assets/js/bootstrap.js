import Echo from "laravel-echo"

window.Echo = new Echo({
    cluster: 'mt1',
    broadcaster: 'pusher',
    key: '321d89618ec4a140cbca',
    encrypted: true
});

// Echo.private(`App.User.${userId}`)
//     .listen('NotificationUpdate', (e) => {
//         console.log(e.update);
//     });
