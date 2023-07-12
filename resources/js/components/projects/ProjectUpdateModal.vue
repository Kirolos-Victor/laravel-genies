<template>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
            :data-bs-target="'#updateProject'+$props.project.id" @click="resetModalValidation(), fetchDevelopers()">
        Update
    </button>
    <!-- Modal -->
    <div class="modal fade" :id="'updateProject'+$props.project.id" data-bs-backdrop="static"
         data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update a project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li class=" text-danger" v-for="error in errors">{{ error }}</li>
                    </ul>
                    <form class="projectUpdateForm">
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
                    <button type="button" class="btn btn-secondary" :id="'closeModal'+$props.project.id"
                            data-bs-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-primary" @click.prevent="updateProject">Update</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {useStore} from "vuex";
import {computed, reactive, ref} from "vue";

export default {
    name: "ProjectUpdateModal",
    props: ['project'],
    setup(props) {
        const statuses = ref(['active', 'completed', 'canceled', 'suspended'])
        const store = useStore();
        const errors = computed(() => store.state.projects.errors);
        const formData = reactive({
            name: props.project.name,
            description: props.project.description,
            status: props.project.status,
            developers: props.project.developers
        })
        const developers = computed(() => store.state.developers.developers)

        function resetModalValidation() {
            store.commit('RESET_ERRORS');
        }

        function updateProject() {
            store.dispatch('updateProject', {index: props.project.id, data: formData});
        }

        function fetchDevelopers() {
            if (developers.value.length <= 0) {
                store.dispatch('fetchDevelopers');
            }
        }

        return {
            errors,
            updateProject,
            formData,
            resetModalValidation,
            statuses,
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
