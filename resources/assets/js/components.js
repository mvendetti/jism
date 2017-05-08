import Vue from 'vue';

export const Components = {
    LayoutPrimary : Vue.component('jism-layout-primary', require('./layouts/primary.vue')),

    Header : Vue.component('jism-header', require('./components/header.vue')),
    HeaderTimer : Vue.component('jism-header-timer', require('./components/header/timer.vue')),
    HeaderStatus : Vue.component('jism-header-status', require('./components/header/status.vue')),
    HeaderBattery : Vue.component('jism-header-battery', require('./components/header/battery.vue')),

    Pod : Vue.component('jism-pod', require('./pages/pod.vue')),
    Add : Vue.component('jism-add', require('./pages/add.vue')),
    Camera : Vue.component('jism-camera', require('./pages/camera.vue')),
    Remove : Vue.component('jism-remove', require('./pages/remove.vue')),
    Disable : Vue.component('jism-disable', require('./pages/disable.vue')),
    PageHome : Vue.component('jism-page-home', require('./pages/home.vue')),
    Settings : Vue.component('jism-settings', require('./pages/settings.vue')),
    PodSettings : Vue.component('jism-pod-settings', require('./pages/podSettings.vue')),
    AssignCamera : Vue.component('jism-assign-camera', require('./pages/assignCamera.vue')),
    CameraReview : Vue.component('jism-camera-review', require('./pages/cameraReview.vue')),
    CameraSettings : Vue.component('jism-camera-settings', require('./pages/cameraSettings.vue')),

    StopButton : Vue.component('jism-button-stop', require('./components/buttons/stop.vue')),
    PauseButton : Vue.component('jism-button-pause', require('./components/buttons/pause.vue')),
    RecordButton : Vue.component('jism-button-record', require('./components/buttons/record.vue')),
    ForwardButton : Vue.component('jism-button-forward', require('./components/buttons/forward.vue')),
    BackwardButton : Vue.component('jism-button-backward', require('./components/buttons/backward.vue')),
    ReferenceButton : Vue.component('jism-button-reference', require('./components/buttons/reference.vue')),

    Footer : Vue.component('jism-footer', require('./components/footers/footer.vue')),
    FooterPod : Vue.component('jism-footer-pod', require('./components/footers/footerPod.vue')),
    FooterMain : Vue.component('jism-footer-main', require('./components/footers/footerMain.vue')),
    FooterAssign : Vue.component('jism-footer-assign', require('./components/footers/footerAssign.vue')),
    FooterCamera : Vue.component('jism-footer-camera', require('./components/footers/footerCamera.vue')),
    FooterReview : Vue.component('jism-footer-review', require('./components/footers/footerReview.vue')),
    FooterDefault : Vue.component('jism-footer-default', require('./components/footers/footerDefault.vue')),
    FooterMainSettings : Vue.component('jism-footer-main-settings', require('./components/footers/footerMainSettings.vue')),
};
