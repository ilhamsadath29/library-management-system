<template>
    <PageComponent>
        <template v-slot:header>
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900">Category - {{ model.id ? `${model.name} Update` : 'Create'}}</h1>
                <router-link :to="{name: 'Category'}" class="py-2 px-3 text-white bg-emerald-500 rounded-md hover:bg-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 -mt-1 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                    </svg>
                    Back
                </router-link>
            </div>
        </template>
        <div >
            <span class="container flex justify-center mx-auto" v-if="loading">loading...</span>
            <form v-else class="mt-8 space-y-6" @submit.prevent="saveData">

                <div class="rounded-md shadow-sm -space-y-px">
                    <div class="pb-2">
                        <label for="name pb-2">Category Name</label>
                    </div>
                    <div class="pb-2">
                        <input
                            id="name"
                            name="name"
                            type="text"
                            autocomplete="off"
                            required
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Category Name"
                            v-model="model.name"
                        />
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-20 group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create</button>
                </div>
            </form>
        </div>
    </PageComponent>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { computed } from "@vue/runtime-core";
import { useRoute, useRouter } from "vue-router";
import PageComponent from "../components/PageComponent.vue";
import store from "../store";

const router = useRouter();
const route = useRoute();

const user = computed(() => store.state.user.data);
const loading = computed(() => store.state.loading);

const model = ref({
    site_id: user.value.site_id,
    name: "",
});

// handle edit page
if (route.params.id) {
    store.dispatch("getCategory", route.params.id).then((data) => {
        model.value = data.data;
    });
}

function saveData() {
    model.value.site_id == user.site_id;
    if(model.value.site_id == null) {
        store.commit("notify", {
            type: "Error",
            message: "Oops. Something wrong.",
        });
    } else {
        store.dispatch("saveCategory", model.value).then((data) => {
            store.commit("notify", {
                type: "Success",
                message: "Rack was successfully updated.",
            });
    
            router.push({
                name: "Category",
            });
        });
    }

}
</script>

<style></style>