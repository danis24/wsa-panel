
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
import Chartkick from 'vue-chartkick';
import AxiosPlugin from 'vue-axios-cors';
import VueLodash from 'vue-lodash'
import lodash from 'lodash'
import store from './store';

import 'vue-loading-overlay/dist/vue-loading.css';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VueCookies);
Vue.use(VueLoading);
Vue.use(Toasted);
Vue.use(VueLocalStorage);
Vue.use(Chartkick);
Vue.use(AxiosPlugin);
Vue.use(VueLodash, { name: 'custom', lodash: lodash })
Vue.localStorage.set('email', document.querySelector("meta[name='email-id']").getAttribute('content'));

import TargetComponent from './components/TargetComponent.vue';
import TargetAddComponent from './components/targets/TargetAddComponent.vue';
import TargetDetailComponent from './components/targets/TargetDetailComponent.vue';
import SubDomainComponent from './components/SubDomainComponent.vue';
import UserManualComponent from './components/UserManualComponent.vue';
import DashboardComponent from './components/DashboardComponent.vue';


const routes = [
    {
        name: 'dashboard',
        path: '/home',
        component: DashboardComponent
    },
    {
        name: 'target',
        path: '/target',
        component: TargetComponent,
    },
    {
        name: 'targetDetail',
        path: '/detail/:id',
        component: TargetDetailComponent,
    },
    {
        name: 'add-target',
        path: '/target/add',
        component: TargetAddComponent,
    },
    {
        name: 'subdomain',
        path: '/subdomain',
        component: SubDomainComponent
    },
    {
        name: 'usermanual',
        path: '/user-manual',
        component: UserManualComponent
    }
];

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active",
    routes: routes
});

const app = new Vue(Vue.util.extend({ store, router })).$mount('#app');
