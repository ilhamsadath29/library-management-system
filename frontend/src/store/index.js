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
        login({ commit }, user) {
            return axiosClient.post('/login', user).then(({ data }) => {
                commit('setUser', data);
                return data;
            });
        },
        logout({ commit }) {
            return axiosClient.post('/logout').then((response) => {
                commit('logout');
                return response;
            });
        },

        // Setting Section ================================================================ 
        getSettings({ commit }) {
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
        getSetting({ commit }, id) {
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
        saveSetting({ commit }, data) {
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
        deleteSetting({ }, id) {
            axiosClient.delete(`/setting/${id}`);
        },
        // End Setting Section ============================================================

        // User Section with site ========================================================= 
        getUsers({ commit }, site_id) {
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
        getUser({ commit }, [site_id, id]) {
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
        saveUser({ commit }, [site_id, data]) {
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
        deleteSiteUser({ }, [site_id, id]) {
            axiosClient.delete(`/${site_id}/site-user/${id}`);
        },
        // End User Section with site =====================================================

        // Rack Section ===================================================================
        getRacks({ commit }) {
            let response;

            commit("setLoading", true);
            response = axiosClient.get('/rack').then(
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
        saveRack({ commit }, data) {
            let response;

            commit("setLoading", true);
            if (data.id) {
                response = axiosClient.put(`/rack/${data.id}`, data).then(
                    (res) => {
                        commit("setLoading", false);
                        return res;
                    }
                ).catch((err) => {
                    commit("setLoading", false);
                    this.dispatch("errDisplay", err);
                    throw err;
                });
            } else {
                response = axiosClient.post('/rack', data).then(
                    (res) => {
                        commit("setLoading", false);
                        return res;
                    }
                ).catch((err) => {
                    commit("setLoading", false);
                    this.dispatch("errDisplay", err);
                    throw err;
                });
            }

            return response;
        },
        getRack({ commit }, id) {
            let response;

            commit("setLoading", true);
            response = axiosClient.get(`/rack/${id}`).then(
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
        deleteRack({ }, id) {
            axiosClient.delete(`/rack/${id}`);
        },
        // End Rack Section ===============================================================

        // Author Section =================================================================
        getAuthors({ commit }) {
            let response;

            commit("setLoading", true);
            response = axiosClient.get('/author').then(
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
        saveAuthor({ commit }, data) {
            let response;

            commit("setLoading", true);
            if (data.id) {
                response = axiosClient.put(`/author/${data.id}`, data).then(
                    (res) => {
                        commit("setLoading", false);
                        return res;
                    }
                ).catch((err) => {
                    commit("setLoading", false);
                    this.dispatch("errDisplay", err);
                    throw err;
                });
            } else {
                response = axiosClient.post('/author', data).then(
                    (res) => {
                        commit("setLoading", false);
                        return res;
                    }
                ).catch((err) => {
                    commit("setLoading", false);
                    this.dispatch("errDisplay", err);
                    throw err;
                });
            }

            return response;
        },
        getAuthor({ commit }, id) {
            let response;

            commit("setLoading", true);
            response = axiosClient.get(`/author/${id}`).then(
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
        deleteAuthor({ }, id) {
            axiosClient.delete(`/author/${id}`);
        },
        // End Author Section =============================================================

        // Category Section ===============================================================
        getCategories({ commit }) {
            let response;

            commit("setLoading", true);
            response = axiosClient.get('/category').then(
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
        saveCategory({ commit }, data) {
            let response;

            commit("setLoading", true);
            if (data.id) {
                response = axiosClient.put(`/category/${data.id}`, data).then(
                    (res) => {
                        commit("setLoading", false);
                        return res;
                    }
                ).catch((err) => {
                    commit("setLoading", false);
                    this.dispatch("errDisplay", err);
                    throw err;
                });
            } else {
                response = axiosClient.post('/category', data).then(
                    (res) => {
                        commit("setLoading", false);
                        return res;
                    }
                ).catch((err) => {
                    commit("setLoading", false);
                    this.dispatch("errDisplay", err);
                    throw err;
                });
            }

            return response;
        },
        getCategory({ commit }, id) {
            let response;

            commit("setLoading", true);
            response = axiosClient.get(`/category/${id}`).then(
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
        deleteCategory({ }, id) {
            axiosClient.delete(`/category/${id}`);
        },
        // End Category Section ===========================================================


        errDisplay({ commit }, err) {
            if (Object.keys(err.response.data.errors).length) {
                let list = Object.keys(err.response.data.errors);
                for (let index = 0; index < list.length; index++) {
                    for (let indexJ = 0; indexJ < err.response.data.errors[list[index]].length; indexJ++) {
                        commit("notify", {
                            type: "Error",
                            message: `Oops!, ${list[index]} -> ${err.response.data.errors[list[index]][indexJ]}`,
                        });
                    }
                }
            } else {
                commit("notify", {
                    type: "Error",
                    message: `Oops! ${err.response.data.message}`,
                });
            }
        }
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