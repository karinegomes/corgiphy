/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueLazyLoad from 'vue-lazyload';
import VueRouter from 'vue-router';

Vue.use(VueLazyLoad);
Vue.use(VueRouter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('lightbox', require('./components/partials/Lightbox.vue').default);
Vue.component('register', require('./components/Register.vue').default);
Vue.component('login', require('./components/Login.vue').default);
Vue.component('favorites', require('./components/Favorites.vue').default);
Vue.component('history', require('./components/History.vue').default);
Vue.component('profile', require('./components/Profile.vue').default);
Vue.component('search', require('./components/Search.vue').default);
Vue.component('home', require('./components/Home.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    mode: 'history',
    routes: [],
});

const app = new Vue({
    router,
    el: '#app',
});
