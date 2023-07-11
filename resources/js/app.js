import './bootstrap';
import {createApp} from 'vue';
import DeveloperIndex from "./components/developers/DeveloperIndex.vue";
import store from './store';
import './toast.js';
import router from './router';

const app = createApp({});

//components
app.component('developer-index', DeveloperIndex);

app.use(store);
app.use(router);

app.mount('#app');
