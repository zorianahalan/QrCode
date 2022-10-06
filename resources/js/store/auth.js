import { createStore } from 'vuex'
import router from '../router/index'
import createPersistedState from "vuex-persistedstate";
export default new createStore({
    state: {
        authenticated: false,
        user: null
    },
    mutations: {
        authenticateUser(state) {
            state.authenticated = true;
        },
        setUser(state, user) {
            state.user = user
        },
        unauthenticateUser(state) {
            state.authenticated = false;
            state.user = null
        }
    },
    actions: {
        async register({ commit }, credentials) {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/register', credentials).then(res => {
                    if (res) {
                        commit('authenticateUser')
                        router.push('/home');
                    }else alert("Error with data!")
                })
            });
        },
        async login({ commit }, credentials) {
            await axios.get('sanctum/csrf-cookie')
                .then(res => {
                    axios.post('/api/login', credentials)
                        .then(data => {
                            if (data) {
                                commit('authenticateUser')
                                router.push('/home');
                            }else alert("Error with data!")
                        })
                });

        },
        async getUser({ commit }, callback) {
            await axios.get('/api/user')
                .then(user => {
                    commit('setUser', user);
                    callback()
                })
        },
        async logout({ commit }) {
            await axios.post('/api/logout')
                .then(data => {
                    localStorage.removeItem('vuex')
                    commit('unauthenticateUser')
                    router.push('/login')
                })

        }

    },
    getters: {
        isAuthenticated(state) {
            return state.authenticated;
        },
        user(state) {
            return state.user;
        },
        userToken(state) {
            return state.token;
        }
    },
    modules: {},
    plugins: [
        createPersistedState()
    ]
})
