
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const LayoutPrimary = require('./layouts/primary.vue')
const PageHome = require('./pages/home.vue')
const Header = require('./components/header.vue')
const Footer = require('./components/footer.vue')
const Camera = require('./components/camera.vue')
const Pod = require('./components/pod.vue')

Vue.component('jism-layout-primary', LayoutPrimary);
Vue.component('jism-page-home', PageHome);
Vue.component('jism-header', Header);
Vue.component('jism-footer', Footer);
Vue.component('jism-camera', Camera);
Vue.component('jism-pod', Pod);

const routes = [
    { path: '/', name: 'home', component: PageHome },
    { path: '/pod/:pod_id', name: 'pod', component: Pod },
    { path: '/pod/:pod_id/cam/:cam_id', name: 'camera', component: Camera }
]

const router = new VueRouter({
    routes, // short for routes: routes
    linkActiveClass: 'active'
})

const app = new Vue({
    el: '#jism-app',
    router
});
