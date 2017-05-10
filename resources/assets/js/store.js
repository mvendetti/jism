import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import landlord from './store/landlord';
import status from './store/status';
import pod from './store/pod';

const store = new Vuex.Store({
    modules: {
        landlord: landlord,
        status: status,
        pod: pod,
    }
});

Jism.vuexGet = function(path, id) {
    var g = store.getters[path],
        v = typeof id === 'undefined' ? g : g(id);
    return typeof v === 'undefined' ? {} : v;
};

export default store;
