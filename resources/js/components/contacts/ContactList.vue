<template>
  <div class="card bg-light my-5">
    <div class="card-header bg-white">
        <!-- navbar -->
        <Navbar />
    </div>
    <div class="row my-3">
        <div class="col-md-6 mx-auto">
            <!-- flash messages -->
            <div 
                :class="$page.props.flash.class"
            >
                {{ $page.props.flash.message }}
            </div>
        </div>
    </div>
    <div v-if="contacts.data.length">
        <div class="card-body">
            <div class="row mb-5">
                <div class="col-md-2 mx-auto">
                    <!-- links for ordering contacts -->
                    <Link 
                        href="/order/asc/contacts"
                        class="text-decoration-none me-1"
                        :class="selectedDirection === 'asc' ? 'text-dark': ''"
                    > 
                        <i class="fas fa-arrow-up"></i>
                    </Link>
                    <Link 
                        href="/order/desc/contacts"
                        class="text-decoration-none me-1"
                        :class="selectedDirection !== 'asc' ? 'text-dark': ''"
                    > 
                        <i class="fas fa-arrow-down"></i>
                    </Link>
                    <span>
                        {{ selectedDirection === 'asc' ? 'A/Z': 'Z/A'}}
                    </span>
                </div>
            </div>
            <div class="row">
                <ContactListItem 
                    v-for="contact in contacts.data"
                    :key="contact.id"
                    :contact="contact"
                    :favorite="user.favorites.some(item => item.user_id === contact.user_id && contact.id === item.id)"
                />
            </div>
        </div>
        <div class="card-footer bg-white d-flex justify-content-center align-items-center">
            <div class="mt-3">
                <ul class="pagination">
                    <li
                        v-for="(link,index) in contacts.links"
                        :key="index"
                        :class="`page-item ${link.active ? 'active' : ''}`"
                    >
                        <Link 
                            :href="link.url"
                            class="page-link"
                            v-if="link.url !== null"
                            v-dompurify-html="link.label"
                        > 
                        </Link>
                        <div
                            v-else
                            class="page-link"
                            v-dompurify-html="link.label"
                        >
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row" v-else>
        <div class="col-md-6 mx-auto">
            <div class="alert alert-primary">
                No contacts found!
            </div>
        </div>
    </div>
  </div>
</template>

<script setup>
    import ContactListItem from "./ContactListItem.vue"
    import Navbar from "../layouts/Navbar.vue"
    import { Link, usePage } from '@inertiajs/vue3'
    import { computed } from "vue"
    
    //get the currently logged user
    const user = computed(() => usePage().props.user)

    //define props 
    const props = defineProps({
        contacts: {
            type: Object,
            required: true
        },
        selectedDirection: {
            type: String,
            default: 'asc'
        }
    })
</script>

<style scoped>
</style>