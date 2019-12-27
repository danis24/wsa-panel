
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import VueCookies from 'vue-cookies';
import VueLoading from 'vue-loading-overlay';
import Toasted from 'vue-toasted';
import VueLocalStorage from 'vue-localstorage';

import 'vue-loading-overlay/dist/vue-loading.css';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VueCookies);
Vue.use(VueLoading);
Vue.use(Toasted);
Vue.use(VueLocalStorage)

import TradeComponent from './components/TradeComponent.vue';
import SettingComponent from './components/SettingComponent.vue';
import AccountComponent from './components/AccountComponent.vue';
import SettingLoadComponent from './components/SettingLoadComponent.vue';

const routes = [
    {
        name: 'trade',
        path: '/trade',
        component: TradeComponent
    },
    {
        name: 'setting',
        path: '/settings',
        component: SettingComponent
    },
    {
        name: 'account',
        path: '/accounts',
        component: AccountComponent
    },
    {
        name: 'load',
        path: '/settings/loads',
        component: SettingLoadComponent
    }
];

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active",
    routes: routes
});

const app = new Vue(Vue.util.extend({ router })).$mount('#app');
