<template>
    <div v-if="notification.show" class="fixed w-[300px] left-4 bottom-4 py-2 px-4 text-white animate-fade-in-down" :class="[notification.type === 'Success' ? 'bg-emerald-500' : 'bg-red-500']">{{ notification.message }}</div>
</template>

<script setup>
import { useStore } from "vuex";
import { computed } from "vue";

const store = useStore();

const notification = computed(() => store.state.notification);
</script>

<style>
</style>