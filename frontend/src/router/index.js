import { createRouter, createWebHistory } from "vue-router"

import AuthLayout from '../components/AuthLayout.vue';
import DefaultLayout from '../components/DefaultLayout.vue';

import Login from '../views/Login.vue';
import Register from '../views/Register.vue';
// import Logout from '../views/Logout.vue';

import Dashboard from '../views/Dashboard.vue';
import Author from '../views/Author.vue';
import Category from '../views/Category.vue';
import Rack from '../views/Rack.vue';
import RackCreateEdit from '../views/RackCreateEdit.vue';
import Book from '../views/Book.vue';
import IssueBook from '../views/IssueBook.vue';

import Setting from '../views/Setting.vue';
import SettingSave from '../views/SettingSave.vue';

import User from '../views/User.vue';
import UserSave from '../views/UserSave.vue';

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
            
            { path: '/setting', name: 'Setting', component: Setting },
            { path: '/setting/create', name: 'SettingCreate', component: SettingSave },
            { path: '/setting/:id', name: 'SettingEdit', component: SettingSave },

            { path: '/:site_id/user', name: 'User', component: User },
            { path: '/:site_id/user/create', name: 'UserCreate', component: UserSave },
            { path: '/:site_id/user/:id', name: 'UserEdit', component: UserSave },

            { path: '/author', name: 'Author', component: Author },
            { path: '/category', name: 'Category', component: Category },
            { path: '/racks', name: 'Rack', component: Rack },
            { path: '/rack/create', name: 'RackCreate', component: RackCreateEdit },
            { path: '/book', name: 'Book', component: Book },
            { path: '/issue-book', name: 'IssueBook', component: IssueBook },
        ]
    },
    // {
    //     path: '/logout',
    //     redirect: '/login',
    //     component: Logout,
    //     name: 'Logout'
    // },
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