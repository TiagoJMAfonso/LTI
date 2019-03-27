import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        ip : '',
        username : '',
        password : ''
    },
});

export default store;