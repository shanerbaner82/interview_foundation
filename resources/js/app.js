import Vue from "vue";
import Vuex from 'vuex'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import store from './store'

require('./bootstrap');

window.Vue = require('vue');

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(Vuex);

const app = new Vue({
    el: '#app',
    store
});
