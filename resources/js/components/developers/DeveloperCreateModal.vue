<template>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary float-end mb-3" data-bs-toggle="modal"
            data-bs-target="#createDeveloper" @click="resetModalValidation">
        Create a developer
    </button>
    <!-- Modal -->
    <div class="modal fade" id="createDeveloper" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create a developer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li class=" text-danger" v-for="error in errors">{{ error }}</li>
                    </ul>
                    <form id="developerCreateForm">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter The Name"
                                   v-model="formData.name">
                        </div>
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter The Email"
                                   v-model="formData.email">
                            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control"
                                   placeholder="Enter The Password" v-model="formData.password">
                        </div>
                        <div class="form-group">
                            <label>Password Confirmation</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                   placeholder="Enter The Password Confirmation"
                                   v-model="formData.password_confirmation">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Enter The Username"
                                   v-model="formData.username">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModal">Close
                    </button>
                    <button type="button" class="btn btn-primary" @click.prevent="addDeveloper">Create</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {useStore} from "vuex";
import {computed, reactive} from "vue";

export default {
    name: "DeveloperCreateModal",
    setup() {
        const store = useStore();
        const errors = computed(() => store.state.developers.errors);
        const formData = reactive({
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            username: ''
        })

        function resetModalValidation() {
            store.commit('RESET_ERRORS');
            formData.name = ''
            formData.email = ''
            formData.password = ''
            formData.password_confirmation = ''
            formData.username = ''
        }

        async function addDeveloper() {
            await store.dispatch('addDeveloper', formData);
        }

        return {
            errors,
            addDeveloper,
            resetModalValidation,
            formData
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
