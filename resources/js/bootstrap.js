import 'bootstrap';

import axios from 'axios';
window.axios = axios;

axios.defaults.baseURL = import.meta.env.VITE_API_BASE_URL;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


