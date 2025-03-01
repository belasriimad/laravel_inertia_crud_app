<template>
    <form class="d-flex" @submit.prevent="findContacts">
        <div class="d-flex align-items-center">
            <div>
                <input 
                    type="text" 
                    placeholder="Search..."
                    v-model="form.searchTerm"
                    class="form-control border border-light border-4"
                >
            </div>
            <div class="mx-1">
                <button 
                    type="submit"
                    class="btn btn-sm btn-dark"
                    :disabled="!form.searchTerm"
                >
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
</template>

<script setup>
    import { useForm } from "@inertiajs/vue3"

    //define the form object
    const form = useForm({
        searchTerm: ''
    })

    //add the find contact function
    const findContacts = () => {
        form.get(route('find.contacts'))
    }
</script>

<style scoped>
</style>