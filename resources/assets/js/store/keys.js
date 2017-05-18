const obj = {
    namespaced: true,
    state: { all: [] },
    actions: {
        LOAD: function ({ commit }) {
            return Jism.get('/api/group/1/settings', 'keys/LOAD');
        },
        STORE: function ({ commit }) {
            return Jism.post('/api/group/1/settings', 'settings/STORE');
        },
    },
    mutations: {
        LOAD: (state, { data }) => {
            state.all = data;
        },
    },
    getters: {
        all: state => {
            return state.all;
        }
    }
};
export default obj;
