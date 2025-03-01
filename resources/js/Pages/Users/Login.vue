<template>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-6 mx-auto mt-5">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="text-center mt-2">
                            Login
                        </h5>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="loginUser">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email*</label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    v-model="form.email"
                                    id="email"
                                    class="form-control"
                                    placeholder="Email*"    
                                >
                                <div
                                    v-if="form.errors.email"
                                    class="text-white bg-danger p-2 rounded my-2"
                                >
                                    {{ form.errors.email }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password*</label>
                                <input 
                                    type="password" 
                                    name="password" 
                                    v-model="form.password"
                                    id="password"
                                    class="form-control"
                                    placeholder="Password*"    
                                >
                                <div
                                    v-if="form.errors.password"
                                    class="text-white bg-danger p-2 rounded my-2"
                                >
                                    {{ form.errors.password }}
                                </div>
                            </div>
                            <div class="my-2">
                                <button type="submit"
                                    class="btn btn-sm btn-dark me-1"
                                >
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-white">
                        New user create account from
                        <Link href="/user/register">
                            here
                        </Link> 
                    </div>
                </div>
            </div>
        </div>     
    </div>
</template>

<script setup>
    import { Link } from "@inertiajs/vue3"
    import { useForm } from '@inertiajs/vue3'

    //define the data object
    const form = useForm({
        email: '',
        password: ''
    })

    //login the user function
    const loginUser = () => {
        form.post(route('user.auth'))
    }
</script>

<style scoped>
</style>