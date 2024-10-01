import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

axios.defaults.withCredentials = true;

axios.get('/sanctum/csrf-cookie').then(response => {
    console.log('CSRF token set');
}).catch(error => {
    console.error('Error initializing CSRF protection:', error);
});
