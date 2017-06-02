const obj = {
    namespaced: true,
    state: { all: [] },
    actions: {
        STORE: function ({ commit, state }, data) {
            return Jism.post('/api/pod', data, 'graph/LOAD');
        },
        DESTROY: function ({ commit, state }, form) {
            return Jism.request('delete', '/api/pod/' + form.pod_id, form, 'graph/LOAD');
        },
    },
    getters: {
        all: state => {
            return state.all;
        },
        find: state => id => {
            return _.find(state.all, function(elem) { return elem.id == id; });
        },
    }
};
export default obj;
