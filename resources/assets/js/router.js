import Vue from 'vue'
import VueRouter from 'vue-router';
import { Components } from './components';

Vue.use(VueRouter);

export const routes = [
    { path: '/', name: 'home', component: Components.PageHome },
    { path: '/settings', name: 'settings', component: Components.Settings },
    { path: '/pod/add', name: 'add', component: Components.PodCreate },
    { path: '/pod/remove', name: 'remove', component: Components.PodDelete },
    { path: '/pod/:pod_id', name: 'pod', component: Components.PodIndex },
    { path: '/pod/:pod_id/settings', name: 'pod-settings', component: Components.PodEdit },
    { path: '/pod/:pod_id/camera/:camera_id', name: 'camera', component: Components.Camera },
    { path: '/pod/:pod_id/camera/:camera_id/review', name: 'review', component: Components.CameraReview },
    { path: '/pod/:pod_id/camera/:camera_id/settings', name: 'camera-settings', component: Components.CameraEdit }
];

export const router = new VueRouter({
    routes,
});
