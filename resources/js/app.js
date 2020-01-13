/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//import Vue from 'vue'
import VueRouter from 'vue-router'
import router from './router';
import VueAxios from 'vue-axios'
import Notifications from 'vue-notification'
import auth from './auth'
import '../../node_modules/bulma/css/bulma.css';
import '../sass/app.scss';
import '../sass/app.sass';
import 'es6-promise/auto'
import axios from 'axios'
import VueAuth from '@websanova/vue-auth'
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'

import navBar from './components/Navbar'
Vue.component('app-navbar', navBar)

// Set Vue router
Vue.router = router
Vue.use(VueRouter)

//Set Vue toast
Vue.use(Notifications)

// Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`
Vue.use(VueAuth, auth)

import App from './views/App'

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
