const obj = {
    namespaced: true,
    state: { all: [] },
    actions: {
        LOAD: function ({ commit }) {
            return Jism.get('/api/group/1/status', 'status/LOAD');
        },
    },
    mutations: {
        LOAD: (state, { data }) => {
            state.all = data;
            setTimeout(() => {
                    Jism.Vue.$store.dispatch('status/LOAD')
                }, 2500);
        },
    },
    getters: {
        all: state => {
            return state.all;
        },
        find: state => pod_id => pod_side => {
            return _.find(state.all, function(elem) { return elem.pod_id == pod_id && elem.pod_side == pod_side; });
        },
    }
};
export default obj;
