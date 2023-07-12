<template>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary float-end mb-3" data-bs-toggle="modal"
            data-bs-target="#createProject" @click="resetModalValidation(), fetchDevelopers()">
        Create a project
    </button>
    <!-- Modal -->
    <div class="modal fade" id="createProject" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create a project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li class=" text-danger" v-for="error in errors">{{ error }}</li>
                    </ul>
                    <form id="projectCreateForm">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter The Name"
                                   v-model="formData.name">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="email" class="form-control" placeholder="Enter The Description"
                                   v-model="formData.description">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-select" v-model="formData.status">
                                <option v-for="status in statuses">{{ status }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select developers that will work on this project</label>
                            <select class="form-select" v-model="formData.developers" multiple>
                                <option v-for="developer in developers" :value="developer.id">
                                    {{ developer.name }}
                                </option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModal">Close
                    </button>
                    <button type="button" class="btn btn-primary" @click.prevent="addProject">Create</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {useStore} from "vuex";
import {computed, reactive, ref} from "vue";

export default {
    name: "ProjectCreateModal",

    setup() {
        const statuses = ref(['active', 'completed', 'canceled', 'suspended'])
        const store = useStore();
        const errors = computed(() => store.state.projects.errors);
        const formData = reactive({
            name: '',
            description: '',
            status: '',
            developers: []
        })
        const developers = computed(() => store.state.developers.developers)

        function resetModalValidation() {
            store.commit('RESET_ERRORS');
            formData.name = ''
            formData.description = ''
            formData.status = ''
            formData.developers = []

        }

        async function addProject() {
            await store.dispatch('addProject', formData);
        }

        function fetchDevelopers() {
            if (developers.value.length <= 0) {
                store.dispatch('fetchDevelopers');
            }
        }

        return {
            statuses,
            errors,
            addProject,
            resetModalValidation,
            formData,
            developers,
            fetchDevelopers
        }
    }
}
</script>

<style scoped>
.form-group {
    margin-top: 10px !important;
    margin-bottom: 20px !important;
}
</style>
