require('./bootstrap');

window.Vue = require('vue');
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import VueRouter from 'vue-router'
import Toasted from 'vue-toasted'
import { VueSpinners } from '@saeris/vue-spinners'
import store from './vuex.js'




Vue.use(VueSpinners);
Vue.use(BootstrapVue);
Vue.use(VueRouter);
Vue.use(Toasted);


Vue.component('navbar', require('./components/navbar.vue').default);


const test = Vue.component('test', require('./components/test.vue').default);
const links = Vue.component('links', require('./components/Links.vue').default);
const hosts = Vue.component('hosts', require('./components/Hosts.vue').default);
const topology = Vue.component('topology', require('./components/Topology.vue').default);
const welcome = Vue.component('welcome', require('./components/welcome.vue').default);
const intents = Vue.component('intents', require('./components/Intents.vue').default);
const flows = Vue.component('flows', require('./components/Flows.vue').default);


const routes = [
    { path: '/devices', component: test, name: 'devices' },
    { path: '/links', component: links, name: 'links' },
    { path: '/hosts', component: hosts, name: 'hosts' },
    { path: '/topology', component: topology, name: 'topology' },
    { path: '/intents', component: intents, name: 'intents' },
    { path: '/flows', component: flows, name: 'flows' },
    { path: '/', component: welcome, name: 'welcome' },
    //{ path: '/bar', component: Bar }
]



const router = new VueRouter({
    routes // short for `routes: routes`
})


const app = new Vue({
    el: '#app',
    router,
    store
});

router.beforeEach((to, from, next) => {
    if ((to.name == 'flows') || (to.name == 'intents') || (to.name == 'topology') || (to.name == 'devices') || (to.name == 'links') || (to.name == 'hosts')) {
        if (store.state.ip == '' || store.state.username == '' || store.state.password == '') {
            next("/");
            return;
        }
    }
    next();
});
