import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import status from './store/status';

const store = new Vuex.Store({
    modules: {
        status: status,
    }
});

Jism.vuexGet = function(path, id) {
    var g = store.getters[path],
        v = typeof id === 'undefined' ? g : g(id);
    return typeof v === 'undefined' ? {} : v;
};

export default store;