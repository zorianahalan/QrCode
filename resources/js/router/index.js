import {createRouter, createWebHistory} from "vue-router";
import auth from "../store/auth";
import Login from "./pages/Login.vue";
import Register from "./pages/Register.vue";
import Home from "./pages/Home.vue";
import Add from "./pages/Add.vue";
import List from "./pages/List.vue";

const routes = [
    { name: 'login', component: Login, path: '/login' },
    { name: 'register', component: Register, path: '/register' },
    { name: 'home', component: Home, path: '/home', children: [
            { name: 'home.add', path: 'add', component: Add },
            { name: 'home.list', path: '', component: List },
        ] },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    // const qr_token = localStorage.getItem('qr_token')
    // if (to.path === '/login' || to.path === '/register') {
    //     if (qr_token) next({ path: '/home' }); else next()
    // }else next()
    const vuex = JSON.parse(localStorage.getItem('vuex')) || { authenticated: false }
    if (to.path === '/login' || to.path === '/register') {
        if (!vuex.authenticated) next()
        else next({ name: 'home' })
    } else if (!vuex.authenticated) next('login')
    else next()



})

export default router
