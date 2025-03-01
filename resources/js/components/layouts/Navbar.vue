<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <Link class="navbar-brand" 
                href="/">
                <i class="fas fa-home"></i>
            </Link>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <Link class="nav-link" 
                            href="#">
                            <i class="fas fa-user"></i> {{ user.data.name }}
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" 
                            href="/user/logout"
                            method="post"
                            >
                            <i class="fas fa-sign-out"></i> Logout
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" 
                            href="/favorites/contacts">
                            <i class="fas fa-star text-warning"></i> {{ user.favorites.length }}
                        </Link>
                    </li>
                </ul>
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <Link class="nav-link" 
                            href="/contacts/add">
                            <i class="fas fa-user-plus"></i>
                        </Link>
                    </li>
                </ul>
                <FindContacts />
            </div>
        </div>
    </nav>
</template>

<script setup>
    import { Link, usePage } from '@inertiajs/vue3'
    import { computed } from 'vue'
    import FindContacts from "../contacts/FindContacts.vue"

    //get the currently logged user
    const user = computed(() => usePage().props.user)
</script>

<style scoped></style>
