import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import landlord from './store/landlord';
import graph from './store/graph';
import keys from './store/keys';
import group from './store/group';
// import pod from './store/pod';
// import camera from './store/camera';
import settings from './store/settings'

const store = new Vuex.Store({
    modules: {
        landlord: landlord,
        graph: graph,
        keys: keys,
        group: group,
        // pod: pod,
        // camera: camera,
        settings: settings,
    }
});

Jism.vuexGet = function(path, id) {
    var g = store.getters[path],
        v = typeof id === 'undefined' ? g : g(id);
    return typeof v === 'undefined' ? {} : v;
};

export default store;
