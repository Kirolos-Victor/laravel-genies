<template>
    <div class="container">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-header">
                    Projects
                </div>
                <div class="card-body">
                    <project-create-modal></project-create-modal>
                    <table class="table">
                        <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Username</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="project in projects">
                            <th scope="row">{{ project.id }}</th>
                            <td>{{ project.name }}</td>
                            <td>{{ project.description }}</td>
                            <td>{{ project.status }}</td>
                            <td>
                                <project-update-modal :project="project"></project-update-modal>
                                <button class="btn btn-danger" style="margin-left: 20px;"
                                        @click.prevent="deleteProject(project.id)">Delete
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {useStore} from "vuex";
import {computed, onMounted} from "vue";
import ProjectCreateModal from "./ProjectCreateModal.vue";
import ProjectUpdateModal from "./ProjectUpdateModal.vue";
import Swal from "sweetalert2";

export default {
    name: "ProjectIndex",
    components: {ProjectCreateModal, ProjectUpdateModal},
    setup() {
        const store = useStore();
        const projects = computed(() => store.state.projects.projects);

        function fetchProjects() {
            store.dispatch('fetchProjects');
        }

        function deleteProject(projectId) {
            console.log(projectId);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    store.dispatch('deleteProject', projectId);
                    Toast.fire({
                        icon: 'success',
                        title: 'Developer deleted successfully'
                    })
                }
            })
        }

        onMounted(() => {
            fetchProjects()
        })

        return {
            projects,
            fetchProjects,
            deleteProject,
        };
    },
}
</script>

<style scoped>

</style>
