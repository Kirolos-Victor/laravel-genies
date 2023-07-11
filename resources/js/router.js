import {createRouter, createWebHistory} from 'vue-router';
import DeveloperIndex from "./components/developers/DeveloperIndex.vue";
import ProjectIndex from "./components/projects/ProjectIndex.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {path: '/developers', component: DeveloperIndex},
        {path: '/projects', component: ProjectIndex},

    ],
});
export default router;

