<template>
  <div class="col-md-4 mb-2">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <!-- link to add contact to favorites -->
                <Link 
                    :href="`/add/contact/${contact.id}/favorites`"
                    class="text-decoration-none text-dark"
                > 
                    <i :class="`fas fa-star ${favorite ? 'text-warning' : ''}`"></i>
                </Link>
                <span class="fw-bold">
                    {{ contact.name }}
                </span>
                <!-- country flag  -->
                <span :class="`fi fi-${contact.country_code ? contact.country_code.toLowerCase() : ''}`"></span> 
            </div>
            <div class="d-flex flex-column my-2">
                <span class="text-primary">
                    {{ contact.company }}
                </span>
                <span>
                    {{ contact.job_title }}
                </span>
            </div>
            <div class="d-flex flex-column my-2">
                <span class="border border-light border-3 rounded p-1 mb-1">
                    <i class="fas fa-phone"></i> {{ contact.phone }}
                </span>
                <span class="border border-light border-3 rounded p-1">
                    <i class="fas fa-envelope"></i> {{ contact.email }}
                </span>
            </div>
            <div class="dropdown">
                <i class="fas fa-ellipsis-vertical"
                    data-bs-toggle="dropdown"
                    style="cursor: pointer"
                ></i>
                <ul class="dropdown-menu">
                    <li>
                        <Link :href="`/contacts/${contact.id}/edit`"
                            class="dropdown-item"
                        > 
                            <i class="fas fa-pen mx-2 text-warning"></i> Update
                        </Link>
                        <Link 
                            :href="`/contacts/delete/${contact.id}`"
                            class="dropdown-item"
                            method="delete"
                        > 
                            <i class="fas fa-trash mx-2 text-danger"></i> Delete
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
  </div>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3'

    //define props 
    const props = defineProps({
        contact: {
            type: Object,
            required: true
        },
        favorite: {
            type: Boolean,
            required: true
        }
    })
</script>

<style scoped>
</style>