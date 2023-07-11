import {createStore} from 'vuex';
import developerModule from './modules/developers.js';
import projectModule from './modules/projects.js';

const store = createStore({
    modules: {
        developers: developerModule,
        projects: projectModule,
    },
});

export default store;
