
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);

import TradeComponent from './components/TradeComponent.vue';
import SettingComponent from './components/SettingComponent.vue';
import AccountComponent from './components/AccountComponent.vue';

const routes = [
    {
        name: 'home',
        path: '/home',
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
    }
];

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active",
    routes: routes
});

const app = new Vue(Vue.util.extend({ router })).$mount('#app');