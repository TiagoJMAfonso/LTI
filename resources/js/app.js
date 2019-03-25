
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import VueRouter from 'vue-router'
import Toasted from 'vue-toasted'
import { VueSpinners } from '@saeris/vue-spinners'




Vue.use(VueSpinners);
Vue.use(BootstrapVue);
Vue.use(VueRouter);
Vue.use(Toasted);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('navbar', require('./components/navbar.vue').default);


const test = Vue.component('test', require('./components/test.vue').default);
const links = Vue.component('links', require('./components/Links.vue').default);
const hosts = Vue.component('hosts', require('./components/Hosts.vue').default);
const topology = Vue.component('topology', require('./components/Topology.vue').default);
const welcome = Vue.component('welcome', require('./components/welcome.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const routes = [
    { path: '/devices', component: test, name: 'devices' },
    { path: '/links', component: links, name: 'links' },
    { path: '/hosts', component: hosts, name: 'hosts' },
    { path: '/topology', component: topology, name: 'topology' },
    { path: '/', component: welcome, name: 'welcome' },
    //{ path: '/bar', component: Bar }
]

const router = new VueRouter({
    routes // short for `routes: routes`
})

const app = new Vue({
    el: '#app',
    router,
    data : function () {
        return{
            ip : '',
            user : '',
            password:'',
        }

    }
});
