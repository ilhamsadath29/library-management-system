
<template>
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow" />
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Sign up to your account</h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Or
                    {{ ' ' }}
                    <router-link :to="{name: 'Login'}" class="font-medium text-indigo-600 hover:text-indigo-500">You can login here.</router-link>
                </p>
            </div>
            <form class="mt-8 space-y-6" @submit="register">
                <input type="hidden" name="remember" value="true" />
                <div class="rounded-md shadow-sm -space-y-px">
                    <div class="pb-2 relative">
                        <div class="mt-1 flex items-center justify-center">
                            <div class="relative w-24 h-24">
                                <span v-if="user.profile === null" class="rounded-full border border-gray-100 shadow-sm">
                                    <svg class="h-[80%] w-[80%] rounded-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </span>
                                <img v-else :src="user.profile" :alt="user.name" class="rounded-full border border-gray-100 shadow-sm" />
                                <!-- <img class="rounded-full border border-gray-100 shadow-sm" src="https://randomuser.me/api/portraits/women/81.jpg" alt="user image" /> -->
                                <button type="button" class="absolute bg-gray-300 border-4 border-white h-8 my-1 right-0 rounded-full bottom-0 w-8 z-2">
                                    <input type="file" class="absolute opacity-0 cursor-pointer" @change="onImageChoose" />
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 pl-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="pb-2">
                        <label for="name" class="sr-only">Name</label>
                        <input
                            id="name"
                            name="name"
                            type="name"
                            autocomplete="name"
                            required
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Name"
                            v-model="user.name"
                        />
                    </div>

                    <div class="pb-2">
                        <label for="address" class="sr-only">Address</label>
                        <input
                            id="address"
                            name="address"
                            type="address"
                            autocomplete="address"
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Address"
                            v-model="user.address"
                        />
                    </div>
                    <div class="pb-2">
                        <label for="contact" class="sr-only">Contact</label>
                        <input
                            id="contact"
                            name="contact"
                            type="contact"
                            autocomplete="contact"
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="contact"
                            v-model="user.contact"
                        />
                    </div>
                    <div class="pb-2">
                        <label for="email-address" class="sr-only">Email address</label>
                        <input
                            id="email-address"
                            name="email"
                            type="email"
                            autocomplete="email"
                            required
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Email"
                            v-model="user.email"
                        />
                    </div>
                    <div class="pb-2">
                        <label for="password" class="sr-only">Password</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            required
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Password"
                            v-model="user.password"
                        />
                    </div>
                    <div class="pb-2">
                        <label for="password_confirmation" class="sr-only">Password Confirmation</label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            autocomplete="current-password_confirmation"
                            required
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Password Confirmation"
                            v-model="user.password_confirmation"
                        />
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
                        </span>
                        Sign up
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { LockClosedIcon } from "@heroicons/vue/solid";
import store from "../store";
import { useRouter } from "vue-router";
import { ref } from "@vue/reactivity";

const router = useRouter();

const user = ref({
    name: "",
    address: "",
    contact: "",
    image: "",
    profile: null,
    email: "",
    password: "",
    password_confirmation: "",
});

const loading = ref(false);
const errors = ref({});

function onImageChoose(ev) {
    const file = ev.target.files[0];

    const reader = new FileReader();
    reader.onload = () => {
        // for send_backend
        user.value.image = reader.result;

        // for display
        user.value.profile = reader.result;
    };
    reader.readAsDataURL(file);
}

function register(ev) {
    ev.preventDefault();
    loading.value = true;
    store.dispatch("register", user.value).then((res) => {
        loading.value = false;

        router.push({
            name: "Dashboard",
        });
    }).catch((err) => {
        if (err.response.status === 422) {
            loading.value = false;
            errors.value = err.response.data.errors;
        }
    });
}
</script>