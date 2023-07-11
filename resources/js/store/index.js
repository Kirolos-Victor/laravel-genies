import {createStore} from 'vuex';
import developerModule from './modules/developers.js';

const store = createStore({
    modules: {
        developers: developerModule,
    },
});

export default store;
