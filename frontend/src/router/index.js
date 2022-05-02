import { createRouter, createWebHistory } from "vue-router"

import AuthLayout from '../components/AuthLayout.vue';
import DefaultLayout from '../components/DefaultLayout.vue';

import Login from '../views/Login.vue';
import Register from '../views/Register.vue';

import Dashboard from '../views/Dashboard.vue';


import store from "../store"

const routes = [
    {
        path: '/auth',
        name: 'Auth',
        redirect: '/login',
        component: AuthLayout,
        meta: { isGuest: true },
        children: [
            { path: '/login', name: 'Login', component: Login },
            { path: '/register', name: 'Register', component: Register },
        ]
    },
    {
        path: '/',
        redirect: '/dashboard',
        component: DefaultLayout,
        meta: { requiresAuth: true },
        children: [
            { path: '/dashboard', name: 'Dashboard', component: Dashboard },
        ]
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

// Login check
router.beforeEach((to, from, next) => {
    // Login page redirect
    if (to.meta.requiresAuth && !store.state.user.token) {
        next({ name: 'Login' })
    }
    // if user exit redirect dashboard page
    else if (store.state.user.token && (to.meta.isGuest)) {
        next({ name: 'Dashboard' })
    }
    else {
        next();
    }
})

export default router;