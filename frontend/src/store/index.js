import { createStore } from "vuex";
import axiosClient from "../axios.js"

const store = createStore({
    state: {
        user: {
            data: {},
            token: sessionStorage.getItem('TOKEN')
        }
    },
    getters: {},
    actions: {
        register({ commit }, user) {
            return axiosClient.post('/register', user).then(({ data }) => {
                commit('setUser', data);
                return data;
            });
        }
    },
    mutations: {
        setUser: (state, userData) => {
            state.user.token = userData.token;
            state.user.data = userData.user;
            sessionStorage.setItem('TOKEN', userData.token);
        }
    },
    modules: {}
});

export default store;