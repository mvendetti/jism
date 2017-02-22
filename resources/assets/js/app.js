
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

const Header = require('./components/header.vue')

const PageHome = require('./pages/home.vue')
const Settings = require('./pages/settings.vue')
const Camera = require('./pages/camera.vue')
const CameraSettings = require('./pages/cameraSettings.vue')
const Pod = require('./pages/pod.vue')
const PodSettings = require('./pages/podSettings.vue')
const AssignCamera = require('./pages/assignCamera.vue')
const CameraReview = require('./pages/cameraReview.vue')
const Add = require('./pages/add.vue')
const Remove = require('./pages/remove.vue')
const Disable = require('./pages/disable.vue')

const StopButton = require('./components/buttons/stop.vue')
const RecordButton = require('./components/buttons/record.vue')
const BackwardButton = require('./components/buttons/backward.vue')
const PauseButton = require('./components/buttons/pause.vue')
const ForwardButton = require('./components/buttons/forward.vue')
const ReferenceButton = require('./components/buttons/reference.vue')

const Footer = require('./components/footers/footer.vue')
const FooterDefault = require('./components/footers/footerDefault.vue')
const FooterMain = require('./components/footers/footerMain.vue')
const FooterMainSettings = require('./components/footers/footerMainSettings.vue')
const FooterAssign = require('./components/footers/footerAssign.vue')
const FooterPod = require('./components/footers/footerPod.vue')
const FooterCamera = require('./components/footers/footerCamera.vue')
const FooterReview = require('./components/footers/footerReview.vue')

Vue.component('jism-layout-primary', LayoutPrimary);

Vue.component('jism-header', Header);

Vue.component('jism-page-home', PageHome);
Vue.component('jism-settings', Settings);
Vue.component('jism-camera', Camera);
Vue.component('jism-camera-settings', CameraSettings);
Vue.component('jism-pod', Pod);
Vue.component('jism-pod-settings', PodSettings);
Vue.component('jism-assign-camera', AssignCamera);
Vue.component('jism-camera-review', CameraReview);
Vue.component('jism-add', Add);
Vue.component('jism-remove', Remove);
Vue.component('jism-disable', Disable);

Vue.component('jism-button-stop', StopButton);
Vue.component('jism-button-record', RecordButton);
Vue.component('jism-button-backward', BackwardButton);
Vue.component('jism-button-pause', PauseButton);
Vue.component('jism-button-forward', ForwardButton);
Vue.component('jism-button-reference', ReferenceButton);

Vue.component('jism-footer', Footer);
Vue.component('jism-footer-default', FooterDefault);
Vue.component('jism-footer-main', FooterMain);
Vue.component('jism-footer-main-settings', FooterMainSettings);
Vue.component('jism-footer-assign', FooterAssign);
Vue.component('jism-footer-pod', FooterPod);
Vue.component('jism-footer-camera', FooterCamera);
Vue.component('jism-footer-review', FooterReview);

const routes = [
    { path: '/', name: 'home', component: PageHome },
    { path: '/assign', name: 'assign', component: AssignCamera },
    { path: '/assign/add', name: 'add', component: Add },
    { path: '/assign/remove', name: 'remove', component: Remove },
    { path: '/assign/disable', name: 'disable', component: Disable },
    { path: '/settings', name: 'settings', component: Settings },
    { path: '/pod/:pod_id', name: 'pod', component: Pod },
    { path: '/pod/:pod_id/cam/:cam_id', name: 'camera', component: Camera },
    { path: '/pod/:pod_id/settings', name: 'pod-settings', component: PodSettings },
    { path: '/pod/:pod_id/cam/:cam_id/review', name: 'review', component: CameraReview },
    { path: '/pod/:pod_id/cam/:cam_id/settings', name: 'cam-settings', component: CameraSettings }
]

const router = new VueRouter({
    routes, // short for routes: routes
    linkActiveClass: 'active'
})

const app = new Vue({
    el: '#jism-app',
    router
});
