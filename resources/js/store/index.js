import Vue from 'vue'
import Vuex from 'vuex'
import token from "./modules/token";
import stars from "./modules/stars";
Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        token,
        stars
    },
})
