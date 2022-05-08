<template>
    <PageComponent>
        <template v-slot:header>
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900">{{ setting.lib_name }} -> user - {{ model.id ? `${model.lib_name} Update` : 'Create'}}</h1>
                <router-link :to="{name: 'Setting'}" class="py-2 px-3 text-white bg-emerald-500 rounded-md hover:bg-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 -mt-1 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                    </svg>
                    Back
                </router-link>
            </div>
        </template>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <span v-if="loading" class="flex justify-center mx-auto">loading</span>
            <form v-else @submit.prevent="saveData">
                <Alert v-if="Object.keys(errors).length" class="flex-col items-stretch text-sm py-2">
                    <div v-for="(field, i) in  Object.keys(errors)" :key="i">
                        <div v-for="(error, ind) in errors[field] || []" :key="ind">
                            {{ error }}
                        </div>
                    </div>
                </Alert>
                
                <div class="drop-shadow-lg bg-gray-500 overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name" v-model="model.name" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="contact" class="block text-sm font-medium text-gray-700">Contact</label>
                                <input type="text" name="contact" id="contact" v-model="model.contact" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />

                            </div>

                            <div class="col-span-6">
                                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                <input type="text" name="address" id="address" v-model="model.address" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" v-model="model.email" :readonly="model.id" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required />
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input type="password" name="password" id="password" v-model="model.password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" :required="model.id ? false : true" />
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select id="status" name="status" v-model="model.status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                    </div>
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
import Alert from '../components/Alert.vue'

const router = useRouter();
const route = useRoute();

const model = ref({
    name: "",
    address: "",
    contact: "",
    email: "",
    password: "",
    status: 1,
});

const setting = ref({});

const loading = computed(() => store.state.loading);
const errors = ref({});

store.dispatch("getSetting", route.params.site_id).then((data) => {
    setting.value = data.data;
});

// handle edit page
if (route.params.id) {
    store.dispatch("getUser", [route.params.site_id, route.params.id]).then((data) => {
        model.value = data.data.user[0];
        model.value.status = data.data.id;
    });
}

function saveData() {
    store.dispatch("saveUser", [route.params.site_id, model.value]).then(({ data }) => {
        errors.value = {};
        store.commit("notify", {
            type: "Success",
            message: "User was successfully updated.",
        });

        router.push({
            name: `User`, params: { site_id: route.params.site_id },
        });
    }).catch((err) => {
        errors.value = err.response.data.errors;
    });
}
</script>

<style></style>