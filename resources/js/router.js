import Home from './views/Home.vue';
import Login from './views/Login.vue';
import Tenant from './views/Tenant.vue';
import VueRouter from 'vue-router'


const routes = [
    { path: '/', component: Home, name: 'Home', meta: { auth: true } },
    { path: '/rates', component: Home, name: 'Rates', meta: { auth: true } },
    { path: '/alerts', component: Home, name: 'Alerts', meta: { auth: true } },
    { path: '/tenants', component: Home, name: 'Tenants', meta: { auth: true } },
    { path: '/tenants/:tenantid', component: Tenant, name: 'Singletenant', meta: { auth: true } },
    { path: '/tenants/:tenantid/usage', component: Tenant, name: 'TenantUsage', meta: { auth: true } },
    //{ path: '/:path?', component: Home, name: 'Home', meta: { auth: true } },
    //{ path: '/tenants', component: Tenants, name: 'Tenants', meta: { auth: true } },
    //{ path: '/tenants/:tenantid', component: Singletenant, name: 'Singletenant', meta: { auth: true } },
    { path: '/login', component: Login, name: 'Login', meta: { auth: false } }
];


const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;