import './bootstrap';
import {createApp} from 'vue';
import DeveloperIndex from "./components/developers/DeveloperIndex.vue";
import store from './store';
import './toast.js';
const app = createApp({});

//components
app.component('developer-index', DeveloperIndex);

app.use(store);

app.mount('#app');
