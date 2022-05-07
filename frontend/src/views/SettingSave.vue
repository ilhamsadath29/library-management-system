<template>
    <PageComponent>
        <template v-slot:header>
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900">Setting - {{ model.id ? `${model.lib_name} Update` : 'Create'}}</h1>
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
                                <label for="lib_name" class="block text-sm font-medium text-gray-700">Library name</label>
                                <input type="text" name="lib_name" id="lib_name" v-model="model.lib_name" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="lib_contact_number" class="block text-sm font-medium text-gray-700">Library contact number</label>
                                <input type="text" name="lib_contact_number" id="lib_contact_number" v-model="model.lib_contact_number" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6">
                                <label for="lib_address" class="block text-sm font-medium text-gray-700">Library address</label>
                                <input type="text" name="lib_address" id="lib_address" v-model="model.lib_address" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="lib_total_book_issue_day" class="block text-sm font-medium text-gray-700">Total book issue day</label>
                                <input type="number" name="lib_total_book_issue_day" id="lib_total_book_issue_day" v-model="model.lib_total_book_issue_day" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <label for="lib_one_day_fine" class="block text-sm font-medium text-gray-700">One day fine</label>
                                <input type="number" name="lib_one_day_fine" id="lib_one_day_fine" v-model="model.lib_one_day_fine" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <label for="lib_issue_total_book_per_user" class="block text-sm font-medium text-gray-700">Issue total book per user</label>
                                <input type="number" name="lib_issue_total_book_per_user" id="lib_issue_total_book_per_user" v-model="model.lib_issue_total_book_per_user" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="lib_currency" class="block text-sm font-medium text-gray-700">Library currency</label>
                                <input type="text" name="lib_currency" id="lib_currency" v-model="model.lib_currency" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <label for="lib_timezone" class="block text-sm font-medium text-gray-700">Timezone</label>
                                <input type="text" name="lib_timezone" id="lib_timezone" v-model="model.lib_timezone" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
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
    lib_name: "",
    lib_address: "",
    lib_contact_number: "",
    lib_total_book_issue_day: "",
    lib_one_day_fine: "",
    lib_issue_total_book_per_user: "",
    lib_currency: "",
    lib_timezone: "",
    status: 1,
});

const loading = computed(() => store.state.loading);
const errors = ref({});

// handle edit page
if (route.params.id) {
    store.dispatch("getSetting", route.params.id).then((data) => {
        model.value = data.data;
    });
}

function saveData() {
    store.dispatch("saveSetting", model.value).then(({ data }) => {
        errors.value = {};
        store.commit("notify", {
            type: "Success",
            message: "Setting was successfully updated.",
        });

        router.push({
            name: `SettingEdit`, params: { id: data.data.id },
        });
    }).catch((err) => {
        errors.value = err.response.data.errors;
    });
}
</script>

<style></style>