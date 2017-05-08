require('./bootstrap');

import store from './store';
import { router } from './router';

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

Jism.Vue = new Vue({
    el: '#jism-app',
    data: {
        shared: Store.state
    },
    router,
    store
});
