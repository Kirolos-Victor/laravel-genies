import { createRouter, createWebHistory } from 'vue-router';
import DeveloperIndex from "./components/developers/DeveloperIndex.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/developers', component: DeveloperIndex },

    ],
});
export default router;

