import axios from 'axios';

const state = {
    projects: [],
    errors: [],
};

const mutations = {
    SET_PROJECTS(state, projects) {
        state.projects = projects;
    },
    ADD_PROJECT(state, project) {
        state.projects.push(project);
    },
    UPDATE_PROJECT(state, updatedProject) {
        const index = state.projects.findIndex(dev => dev.id === updatedProject.id);
        if (index !== -1) {
            state.projects.splice(index, 1, updatedProject);
        }
    },
    DELETE_PROJECT(state, projectId) {
        const index = state.projects.findIndex(dev => dev.id === projectId);
        if (index !== -1) {
            state.projects.splice(index, 1);
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
    fetchProjects({commit}) {
        axios.get('/api/projects')
            .then(response => {
                commit('SET_PROJECTS', response.data);
            })
            .catch(error => {
                console.error(error);
            });
    },
    addProject({commit}, payload) {
        axios.post('/api/projects/create', payload)
            .then(response => {
                commit('RESET_ERRORS');
                commit('ADD_PROJECT', response.data);
                document.getElementById('closeModal').click();
                Toast.fire({
                    icon: 'success',
                    title: 'Project created successfully'
                })
            })
            .catch(error => {
                commit('SET_ERRORS', error.response.data.errors)
            });
    },
    updateProject({commit}, payload) {
        axios.put(`/api/projects/` + payload.index, payload.data)
            .then(response => {
                commit('RESET_ERRORS');
                commit('UPDATE_PROJECT', response.data);
                document.getElementById('closeModal' + payload.index).click()
                Toast.fire({
                    icon: 'success',
                    title: 'Project updated successfully'
                })
            })
            .catch(error => {
                commit('SET_ERRORS', error.response.data.errors)
            });
    },
    deleteProject({commit}, projectId) {
        axios.delete(`/api/projects/` + projectId)
            .then(() => {
                commit('DELETE_PROJECT', projectId);
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
