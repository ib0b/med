

require('./bootstrap');

window.Vue = require('vue');
//import Vue from 'vue'
Vue.config.devtools = true;
import VueRouter from 'vue-router'
import {routes} from './routes'
//import routes
const router = new VueRouter({
    routes,
    mode:'history'
})
Vue.use(VueRouter)

const app = new Vue({
    el: '#app',
    router
});
