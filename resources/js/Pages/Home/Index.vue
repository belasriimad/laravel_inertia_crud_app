<template>
  <div class="container">
    <ContactList 
      :contacts="contacts"
      :selectedDirection="selectedDirection"
    />
  </div>
</template>

<script setup>
  import ContactList from "../../components/contacts/ContactList.vue"

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