<template>
    <div class="container">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-header">
                    <router-link to="/developers">Developers</router-link>
                </div>
                <div class="card-body">
                    <developer-create-modal></developer-create-modal>
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
                        <tr v-for="developer in developers">
                            <th scope="row">{{ developer.id }}</th>
                            <td>{{ developer.name }}</td>
                            <td>{{ developer.email }}</td>
                            <td>{{ developer.username }}</td>
                            <td>
                                <developer-update-modal :developer="developer"></developer-update-modal>
                                <button class="btn btn-danger" style="margin-left: 20px;" @click.prevent="deleteDeveloper(developer.id)">Delete</button>
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
import DeveloperCreateModal from "./DeveloperCreateModal.vue";
import DeveloperUpdateModal from "./DeveloperUpdateModal.vue";
import Swal from "sweetalert2";

export default {
    name: "DeveloperIndex",
    components: {DeveloperUpdateModal, DeveloperCreateModal},
    setup() {
        const store = useStore();
        const developers = computed(() => store.state.developers.developers);

        function fetchDevelopers() {
            store.dispatch('fetchDevelopers');
        }

        function deleteDeveloper(developerId) {
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
                    store.dispatch('deleteDeveloper', developerId);
                    Toast.fire({
                        icon: 'success',
                        title: 'Developer deleted successfully'
                    })
                }
            })
        }

        onMounted(() => {
            fetchDevelopers()
        })

        return {
            developers,
            fetchDevelopers,
            deleteDeveloper,
        };
    },
}
</script>

<style scoped>

</style>
