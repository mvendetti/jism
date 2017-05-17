import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import landlord from './store/landlord';
import status from './store/status';
import group from './store/group';
import pod from './store/pod';
import camera from './store/camera';

const store = new Vuex.Store({
    modules: {
        landlord: landlord,
        status: status,
        group: group,
        pod: pod,
        camera: camera,
    }
});

Jism.vuexGet = function(path, id) {
    var g = store.getters[path],
        v = typeof id === 'undefined' ? g : g(id);
    return typeof v === 'undefined' ? {} : v;
};

export default store;
