import axios from 'axios';

const state = {
    developers: [],
    errors: [],
};

const mutations = {
    SET_DEVELOPERS(state, developers) {
        state.developers = developers;
    },
    ADD_DEVELOPER(state, developer) {
        state.developers.push(developer);
    },
    UPDATE_DEVELOPER(state, updatedDeveloper) {
        const index = state.developers.findIndex(dev => dev.id === updatedDeveloper.id);
        if (index !== -1) {
            state.developers.splice(index, 1, updatedDeveloper);
        }
    },
    DELETE_DEVELOPER(state, developerId) {
        const index = state.developers.findIndex(dev => dev.id === developerId);
        if (index !== -1) {
            state.developers.splice(index, 1);
        }
    },
    SET_ERRORS(state, errors) {
        state.errors = errors;
    },
    RESET_ERRORS(state) {
        state.errors = [];
    }
};

const actions = {
    fetchDevelopers({commit}) {
        axios.get('/api/developers')
            .then(response => {
                commit('SET_DEVELOPERS', response.data);
            })
            .catch(error => {
                console.error(error);
            });
    },
    addDeveloper({commit}, payload) {
        axios.post('/api/developers/create', payload)
            .then(response => {
                commit('RESET_ERRORS');
                commit('ADD_DEVELOPER', response.data);
                document.getElementById('closeModal').click();
                Toast.fire({
                    icon: 'success',
                    title: 'Developer created successfully'
                })
            })
            .catch(error => {
                commit('SET_ERRORS', error.response.data.errors)
            });
    },
    updateDeveloper({commit}, payload) {
        axios.put(`/api/developers/` + payload.index, payload.data)
            .then(response => {
                commit('RESET_ERRORS');
                commit('UPDATE_DEVELOPER', response.data);
                document.getElementById('closeModal' + payload.index).click()
                Toast.fire({
                    icon: 'success',
                    title: 'Developer updated successfully'
                })
            })
            .catch(error => {
                commit('SET_ERRORS', error.response.data.errors)
            });
    },
    deleteDeveloper({commit}, developerId) {
        axios.delete(`/api/developers/` + developerId)
            .then(() => {
                commit('DELETE_DEVELOPER', developerId);
            })
            .catch(error => {
                console.error(error);
            });
    },
};

export default {
    state,
    mutations,
    actions,
};
