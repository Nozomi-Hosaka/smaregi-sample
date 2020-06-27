/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Auth from "./src/Auth/Auth";

require('./bootstrap');
import '@fortawesome/fontawesome-free/css/all.css';

window.Vue = require('vue');
import router from './plugins/router';
import store from './plugins/store';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('app', require('./App.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/**
 * Vue init auth
 */
const auth = async () => {
    // const auth = new Auth();
    // const user = await auth.user();
    // if (user) {
    //     await store.dispatch('auth/setUser', user);
    // }
};

/**
 * Vue router's Auth guard
 */
router.beforeEach((to, from, next) => {
    const isPublic = to.matched.some((record) => {
        return record.meta.public;
    });
    if (isPublic) {
        next();
        return;
    }
    if (!store.getters['auth/logged_in']) {
        next({name: 'login'});
        return;
    }
    next();
});

/**
 * Vue load afterAuth check.
 */
auth().then(() => {
    // eslint-disable-next-line no-unused-vars,no-undef
    const app = new Vue({
        el: '#app',
        router,
        store
    });
});
