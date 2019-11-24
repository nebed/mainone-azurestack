require('./bootstrap');
import Vue from 'vue'
import VueRouter from 'vue-router'
import router from './routes';
import VueAxios from 'vue-axios'
import auth from './auth'
import '../../node_modules/bulma/css/bulma.css';
import '../sass/app.scss';
import 'es6-promise/auto'
import axios from 'axios'
import VueAuth from '@websanova/vue-auth'

// Set Vue router
Vue.router = router
Vue.use(VueRouter)
// Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`
Vue.use(VueAuth, auth)

import App from './views/App'
import Home from './views/Home'
import Tenants from './views/Tenants'
import Login from './views/Login'
import Singletenant from './views/Singletenant'

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});