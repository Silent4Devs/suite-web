window.axios = require('axios');
window.Swal = require('sweetalert2')
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.html2canvas = require('html2canvas')
// window.OrgChart = require('orgchart');


/**
 * Librerias COREUI
 */



/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});
