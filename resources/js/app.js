import './bootstrap';
import {createApp} from 'vue';
import store from './store';
import './toast.js';
import router from './router';

const app = createApp({});
//components

app.use(store);
app.use(router);

app.mount('#app');
