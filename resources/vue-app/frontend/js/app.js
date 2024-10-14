import Vue from 'vue'
import VueRouter from 'vue-router'

import commonMixin from "../../utils/mixins/commonMixin";
import httpMixin from "../../utils/mixins/httpMixin";

Vue.use(VueRouter);
import App from './App.vue'
import route from './routes'


// import {store as storeData} from './store';
//
// const store = new Vuex.Store(storeData);


import {store as storeData} from "../../utils/store";
import Vuex from "vuex";
Vue.use(Vuex);
const store = new Vuex.Store(storeData);

const router = new VueRouter({
    mode : 'history',
    routes : route,
    linkActiveClass : 'active'
});


Vue.mixin(commonMixin);
Vue.mixin(httpMixin);


const vue = new Vue({
    el : '#app',
    components : {App},
    router, store
});