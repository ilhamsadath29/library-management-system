import { createStore } from "vuex";
import axiosClient from "../axios.js"

const store = createStore({
    state: {
        user: {
            data: {},
            token: sessionStorage.getItem('TOKEN')
        },
        loading: false
    },
    getters: {},
    actions: {
        register({ commit }, user) {
            return axiosClient.post('/register', user).then(({ data }) => {
                commit('setUser', data);
                return data;
            });
        },
        login({commit}, user) {
            return axiosClient.post('/login', user).then(({ data }) => {
                commit('setUser', data);
                return data;
            });
        },
        logout({commit}) {
            return axiosClient.post('/logout').then((response) => {
                commit('logout');
                return response;
            });
        },
        saveRack({commit}, rack) {
            commit("setLoading", true);
            return axiosClient.post('/rack', rack).then(
                (res) => {
                    commit("setLoading", false);
                    return res;
                }
            );;
        },
        getRack({commit}, id) {
            commit("setLoading", true);
            axiosClient.get(`/rack/${id}`).then(
                (res) => {
                    commit("setCurrentSurvey", res.data);
                    commit("setLoading", false);
                    return res;
                }
            ).catch(
                (err) => {
                    commit("setLoading", false);
                    throw err;
                }
            );
        }
    },
    mutations: {
        logout: (state) => {
            state.user.data = {};
            state.user.token = null;
        },
        setUser: (state, userData) => {
            state.user.token = userData.token;
            state.user.data = userData.user;
            sessionStorage.setItem('TOKEN', userData.token);
        },
        setLoading: (state, loading) => {
            state.loading = loading;
        }
    },
    modules: {}
});

export default store;