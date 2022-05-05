<template>
  
</template>

<script>
import { computed } from "@vue/runtime-core";
import { useRouter } from "vue-router";
import store from "../store";


const router = useRouter();

computed (() => {
    // logout();
})

function logout() {
    store.dispatch("logout").then((res) => {
        router.push({
            name: "Login",
        });
    });
}
</script>

<style>

</style>