const obj = {
    namespaced: true,
    state: { all: [] },
    actions: {
        LOAD: function ({ commit }) {
            return Jism.get('/api/pod', 'pod/LOAD');
        },
    },
    mutations: {
        LOAD: (state, { data }) => {
            state.all = Jism.massMergeModels(state.all, data);
        },
    },
    getters: {
        all: state => {
            return state.all;
        },
        find: state => number => {
            return _.find(state.all, function(elem) { return elem.pod_id == number; });
        },
    }
};
export default obj;
