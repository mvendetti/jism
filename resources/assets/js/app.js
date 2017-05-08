require('./bootstrap');

import store from './store';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

const LayoutPrimary = require('./layouts/primary.vue')

const Header = require('./components/header.vue')
const HeaderTimer = require('./components/header/timer.vue')
const HeaderStatus = require('./components/header/status.vue')
const HeaderBattery = require('./components/header/battery.vue')

const Pod = require('./pages/pod.vue')
const Add = require('./pages/add.vue')
const PageHome = require('./pages/home.vue')
const Camera = require('./pages/camera.vue')
const Remove = require('./pages/remove.vue')
const Disable = require('./pages/disable.vue')
const Settings = require('./pages/settings.vue')
const PodSettings = require('./pages/podSettings.vue')
const AssignCamera = require('./pages/assignCamera.vue')
const CameraReview = require('./pages/cameraReview.vue')
const CameraSettings = require('./pages/cameraSettings.vue')

const StopButton = require('./components/buttons/stop.vue')
const PauseButton = require('./components/buttons/pause.vue')
const RecordButton = require('./components/buttons/record.vue')
const ForwardButton = require('./components/buttons/forward.vue')
const BackwardButton = require('./components/buttons/backward.vue')
const ReferenceButton = require('./components/buttons/reference.vue')

const Footer = require('./components/footers/footer.vue')
const FooterPod = require('./components/footers/footerPod.vue')
const FooterMain = require('./components/footers/footerMain.vue')
const FooterAssign = require('./components/footers/footerAssign.vue')
const FooterCamera = require('./components/footers/footerCamera.vue')
const FooterReview = require('./components/footers/footerReview.vue')
const FooterDefault = require('./components/footers/footerDefault.vue')
const FooterMainSettings = require('./components/footers/footerMainSettings.vue')

Vue.component('jism-layout-primary', LayoutPrimary);

Vue.component('jism-header', Header);
Vue.component('jism-header-timer', HeaderTimer);
Vue.component('jism-header-status', HeaderStatus);
Vue.component('jism-header-battery', HeaderBattery);

Vue.component('jism-pod', Pod);
Vue.component('jism-add', Add);
Vue.component('jism-camera', Camera);
Vue.component('jism-remove', Remove);
Vue.component('jism-disable', Disable);
Vue.component('jism-settings', Settings);
Vue.component('jism-page-home', PageHome);
Vue.component('jism-pod-settings', PodSettings);
Vue.component('jism-assign-camera', AssignCamera);
Vue.component('jism-camera-review', CameraReview);
Vue.component('jism-camera-settings', CameraSettings);

Vue.component('jism-button-stop', StopButton);
Vue.component('jism-button-pause', PauseButton);
Vue.component('jism-button-record', RecordButton);
Vue.component('jism-button-forward', ForwardButton);
Vue.component('jism-button-backward', BackwardButton);
Vue.component('jism-button-reference', ReferenceButton);

Vue.component('jism-footer', Footer);
Vue.component('jism-footer-pod', FooterPod);
Vue.component('jism-footer-main', FooterMain);
Vue.component('jism-footer-assign', FooterAssign);
Vue.component('jism-footer-camera', FooterCamera);
Vue.component('jism-footer-review', FooterReview);
Vue.component('jism-footer-default', FooterDefault);
Vue.component('jism-footer-main-settings', FooterMainSettings);

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

var Store = {
    state: {
        cameras: [],
        pods: [],
        settings: {
            type: '0', protune: '1', format: '0',
            resolution: '1', fps: '8', fov: '0',
            colorTemp: '2', colorProfile: '1',
            shutter: '13', iso: '8', sharpness: '1',
            exposure: '4', orientation: '1'
        }
    }
};

const router = new VueRouter({
    routes, // short for routes: routes
    linkActiveClass: 'active'
});

Jism.Vue = new Vue({
    el: '#jism-app',
    data: {
        shared: Store.state
    },
    router,
    store
});
