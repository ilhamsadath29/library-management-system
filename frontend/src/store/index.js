import { createStore } from "vuex";
import axiosClient from "../axios.js"

const store = createStore({
    state: {
        user: {
            data: JSON.parse(sessionStorage.getItem('USER_DATA')),
            token: sessionStorage.getItem('TOKEN')
        },
        loading: false,
        notification: {
            show: false,
            type: null,
            message: null
        },
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
        saveRack({commit}, data) {
            commit("setLoading", true);
            return axiosClient.post('/rack', data).then(
                (res) => {
                    commit("setLoading", false);
                    return res;
                }
            );
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
        },
        getSettings({commit}, id) {
            let response;

            commit("setLoading", true);
            response = axiosClient.get('/setting').then(
                (res) => {
                    commit("setLoading", false);
                    return res.data;
                }
            ).catch(
                (err) => {
                    commit("setLoading", false);
                    throw err;
                }
            );

            return response;
        },
        getSetting({commit}, id) {
            let response;

            commit("setLoading", true);
            response = axiosClient.get(`/setting/${id}`).then(
                (res) => {
                    commit("setLoading", false);
                    if (res.status === 200) {
                        return res.data;
                    }
                }
            ).catch(
                (err) => {
                    commit("setLoading", false);
                    throw err;
                }
            );

            return response;
        },
        saveSetting({commit}, data) {
            commit("setLoading", true);
            let response;
            if (data.id) {
                response = axiosClient.put(`/setting/${data.id}`, data).then(
                    (res) => {
                        commit("setLoading", false);
                        return res;
                    }
                );
            } else {
                response = axiosClient.post('/setting', data).then(
                    (res) => {
                        commit("setLoading", false);
                        return res;
                    }
                ).catch(error => {
                    commit("setLoading", false);
                    throw error;
                });
            }

            return response;
        },
        deleteSetting({} , id) {
            axiosClient.delete(`/setting/${id}`);
        },
        // User Section with site ========================================================= 
        getUsers({commit}, site_id) {
            let response;

            commit("setLoading", true);
            response = axiosClient.get(`/${site_id}/site-user`).then(
                (res) => {
                    commit("setLoading", false);
                    return res.data;
                }
            ).catch(
                (err) => {
                    commit("setLoading", false);
                    throw err;
                }
            );

            return response;
        },
        getUser({commit}, [site_id, id]) {
            let response;

            commit("setLoading", true);
            response = axiosClient.get(`/${site_id}/site-user/${id}`).then(
                (res) => {
                    commit("setLoading", false);
                    if (res.status === 200) {
                        return res.data;
                    }
                }
            ).catch(
                (err) => {
                    commit("setLoading", false);
                    throw err;
                }
            );

            return response;
        },
        saveUser({commit}, [site_id, data]) {
            commit("setLoading", true);
            let response;
            if (data.id) {
                response = axiosClient.put(`/${site_id}/site-user/${data.id}`, data).then(
                    (res) => {
                        commit("setLoading", false);
                        return res;
                    }
                );
            } else {
                response = axiosClient.post(`/${site_id}/site-user`, data).then(
                    (res) => {
                        commit("setLoading", false);
                        return res;
                    }
                ).catch(error => {
                    commit("setLoading", false);
                    throw error;
                });
            }
            
            return response;
        },
        deleteSiteUser({}, [site_id, id]) {
            axiosClient.delete(`/${site_id}/site-user/${id}`);
        }

        // End User Section with site ========================================================= 
    },
    mutations: {
        logout: (state) => {
            state.user.data = {};
            state.user.token = null;
            sessionStorage.clear();
        },
        setUser: (state, userData) => {
            state.user.token = userData.token;
            state.user.data = userData.user;
            sessionStorage.setItem('USER_DATA', JSON.stringify(userData.user));
            sessionStorage.setItem('TOKEN', userData.token);
        },
        setLoading: (state, loading) => {
            state.loading = loading;
        },
        notify: (state, { message, type }) => {
            state.notification.show = true;
            state.notification.type = type;
            state.notification.message = message;

            setTimeout(() => {
                state.notification.show = false;
                state.notification.type = null;
                state.notification.message = null;
            }, 3000);
        }
    },
    modules: {}
});

export default store;