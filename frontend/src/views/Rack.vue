<template>
    <PageComponent>
        <template v-slot:header>
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900">Racks</h1>
                <router-link :to="{name: 'RackCreate'}" class="py-2 px-3 text-white bg-emerald-500 rounded-md hover:bg-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 -mt-1 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Add new Rack
                </router-link>
            </div>
        </template>

        <div class="container flex justify-center mx-auto">
            <span v-if="loading">loading...</span>
            <div v-else  class="flex flex-col">
                <div class="w-full">
                    <div class="border-b border-gray-200 shadow">
                        <table class="divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-2 text-xs text-gray-500">No</th>
                                    <th class="px-6 py-2 text-xs text-gray-500">Name</th>
                                    <th class="px-6 py-2 text-xs text-gray-500">Status</th>
                                    <th class="px-6 py-2 text-xs text-gray-500" v-if="user.id === 1">Edit / Delete</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-300">
                                <tr class="whitespace-nowrap" v-for="(item, ind) in list" :key="ind">
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ ind+1 }}</td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ item.name }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ item.status === 1 ? 'Active' : 'Inactive' }}</td>
                                    <td class="px-6 py-4 inline-flex space-x-4" v-if="user.id === 1">
                                        <router-link  :to="{name: 'RackEdit', params: { id: item.id}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </router-link>
                                    
                                        <button type="button" @click="deleteItem(item)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </PageComponent>
</template>

<script setup>
import { computed, ref } from "@vue/runtime-core";
import PageComponent from "../components/PageComponent.vue";
import store from "../store";

const list = ref({});
const user = computed(() => store.state.user.data);
const loading = computed(() => store.state.loading);

store.dispatch("getRacks").then((data) => {
    list.value = data.data;
});

function deleteItem(data) {
    if (confirm("Are you want to delete this?")) {
        store.dispatch("deleteSetting", data.id).then(
            list.value.splice(list.value.map(item => item.id).indexOf(data.id), 1) // remove it from array
        );
    }
}
</script>
<style></style>