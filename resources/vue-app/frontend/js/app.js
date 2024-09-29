import Vue from 'vue'
import VueRouter from 'vue-router'

import commonMixin from "./mixins/commonMixin";
import httpMixin from "./mixins/httpMixin";

Vue.use(VueRouter);
import App from './App.vue'
import route from './routes'

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
    router
});