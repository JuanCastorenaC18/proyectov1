import Echo from 'laravel-echo'

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true,
    authEndpoint: '/broadcasting/auth',
    auth: {
        headers: {
            'Authorization': 'Bearer ' + token
        }
    }
})

window.Echo.private('qrauth')
    .listen('.qrauth', ({ success }) => {
        if (success) {
            console.log('Authentication successful')
        } else {
            console.log('Authentication failed')
        }
    })

window.Echo.connector.socket.on('connect', () => {
    console.log('WebSocket connected')
})
