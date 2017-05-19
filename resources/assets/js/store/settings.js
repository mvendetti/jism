const obj = {
    namespaced: true,
    state: { all: [] },
    actions: {
        LOAD: function ({ commit }) {
            return Jism.get('/api/group/1/settings', 'settings/LOAD');
        },
        STORE: function ({ commit, state }, form) {
            return Jism.post('/api/group/1/settings', form, 'settings/STORE');
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
