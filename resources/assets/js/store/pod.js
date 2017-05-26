const obj = {
    namespaced: true,
    state: { all: [] },
    actions: {
        STORE: function ({ commit, state }, data) {
            return Jism.post('/api/pod', data, 'graph/LOAD');
        },
        DESTROY: function ({ commit, state }, id) {
            return Jism.request('delete', '/api/pod/' + id, null, 'graph/LOAD');
        },
    },
    getters: {
        all: state => {
            return state.all;
        },
        find: state => number => {
            return _.find(state.all, function(elem) { return elem.number == number; });
        },
    }
};
export default obj;
