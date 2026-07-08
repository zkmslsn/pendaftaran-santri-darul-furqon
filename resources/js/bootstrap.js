import axios from 'axios';

// Menyediakan klien HTTP global dengan penanda request AJAX untuk Laravel.
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
