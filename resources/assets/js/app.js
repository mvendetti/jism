
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
const Footer = require('./components/footers/footer.vue')
const FooterStandard = require('./components/footers/footerStandard')
const FooterMain = require('./components/footers/footerMain.vue')
const FooterMainSettings = require('./components/footers/footerMainSettings.vue')
const FooterAvailable = require('./components/footers/footerAvailable')
const FooterPod = require('./components/footers/footerPod.vue')
const FooterCamera = require('./components/footers/footerCamera.vue')
const Camera = require('./pages/camera.vue')
const Pod = require('./pages/pod.vue')

Vue.component('jism-layout-primary', LayoutPrimary);
Vue.component('jism-page-home', PageHome);
Vue.component('jism-header', Header);
Vue.component('jism-footer', Footer);
Vue.component('jism-footer-standard', FooterStandard);
Vue.component('jism-footer-main', FooterMain);
Vue.component('jism-footer-main-settings', FooterMainSettings);
Vue.component('jism-footer-available', FooterAvailable);
Vue.component('jism-footer-pod', FooterPod);
Vue.component('jism-footer-camera', FooterCamera);
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
