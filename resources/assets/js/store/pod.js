const obj = {
    namespaced: true,
    state: { all: [] },
    actions: {
        LOAD: function ({ commit }) {
            return Jism.get('/api/pod', 'pod/LOAD');
        },
        STORE: function ({ commit, state }, data) {
            return Jism.post('/api/pod', data, 'pod/STORE');
        },
        UPDATE: function ({ commit, state }, data) {
            return Jism.patch('/api/pod/:pod_id', data, 'pod/STORE');
        },
        DESTROY: function ({ commit, state }, id) {
            return Jism.destroy('/api/pod/' + id, 'pod/DESTROY', id);
        },
    },
    mutations: {
        LOAD: (state, { data }) => {
            state.all = Jism.massMergeModels(state.all, data);
        },
        STORE: (state, { item }) => {
            state.all = Jism.massMergeModels(state.all, [item]);
        },
        DESTROY: (state, { id }) => {
            state.all = Jism.removeModel(state.all, id);
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
