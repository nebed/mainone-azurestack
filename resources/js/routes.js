import Home from './views/Home.vue';
import Tenants from './views/Tenants.vue';
import Login from './views/Login.vue';
import Singletenant from './views/Singletenant.vue';
import VueRouter from 'vue-router'


const routes = [
    { path: '/', component: Home, name: 'Home', meta: { auth: true } },
    { path: '/tenants', component: Tenants, name: 'Tenants', meta: { auth: true } },
    { path: '/tenants/:tenantid', component: Singletenant, name: 'Singletenant', meta: { auth: true } },
    { path: '/login', component: Login, name: 'Login', meta: { auth: false } }
];


const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;