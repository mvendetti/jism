import Vue from 'vue';

export const Components = {
    LayoutPrimary : Vue.component('jism-layout-primary', require('./layouts/primary.vue')),

    Breadcrumb : Vue.component('jism-breadcrumb', require('./components/nav/breadcrumb.vue')),

    Header : Vue.component('jism-header', require('./components/header/header.vue')),
    HeaderTimer : Vue.component('jism-header-timer', require('./components/header/timer.vue')),
    HeaderStatus : Vue.component('jism-header-status', require('./components/header/status.vue')),
    HeaderBattery : Vue.component('jism-header-battery', require('./components/header/battery.vue')),

    PageHome : Vue.component('jism-page-home', require('./pages/home.vue')),
    Settings : Vue.component('jism-settings', require('./pages/settings.vue')),

    PodEdit : Vue.component('jism-pod-edit', require('./pages/pod/edit.vue')),
    PodIndex : Vue.component('jism-pod-index', require('./pages/pod/index.vue')),
    PodCreate : Vue.component('jism-pod-add', require('./pages/pod/create.vue')),
    PodDelete : Vue.component('jism-pod-delete', require('./pages/pod/delete.vue')),

    CameraEdit : Vue.component('jism-camera-edit', require('./pages/camera/edit.vue')),
    CameraIndex : Vue.component('jism-camera-index', require('./pages/camera/index.vue')),
    CameraReview : Vue.component('jism-camera-review', require('./pages/camera/review.vue')),

    StopButton : Vue.component('jism-button-stop', require('./components/buttons/stop.vue')),
    PauseButton : Vue.component('jism-button-pause', require('./components/buttons/pause.vue')),
    RecordButton : Vue.component('jism-button-record', require('./components/buttons/record.vue')),
    ForwardButton : Vue.component('jism-button-forward', require('./components/buttons/forward.vue')),
    BackwardButton : Vue.component('jism-button-backward', require('./components/buttons/backward.vue')),
    ReferenceButton : Vue.component('jism-button-reference', require('./components/buttons/reference.vue')),

    Footer : Vue.component('jism-footer', require('./components/footer/footer.vue')),
    FooterPod : Vue.component('jism-footer-pod', require('./components/footer/footerPod.vue')),
    FooterMain : Vue.component('jism-footer-main', require('./components/footer/footerMain.vue')),
    FooterAdd : Vue.component('jism-footer-add', require('./components/footer/footerAdd.vue')),
    FooterCamera : Vue.component('jism-footer-camera', require('./components/footer/footerCamera.vue')),
    FooterReview : Vue.component('jism-footer-review', require('./components/footer/footerReview.vue')),
    FooterDefault : Vue.component('jism-footer-default', require('./components/footer/footerDefault.vue')),
    FooterMainSettings : Vue.component('jism-footer-main-settings', require('./components/footer/footerMainSettings.vue')),
};
