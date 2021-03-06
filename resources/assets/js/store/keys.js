const obj = {
    namespaced: true,
    state: { all: [] },
    actions: {
        LOAD: function ({ commit }) {
            return Jism.get('/api/key/settings', 'keys/LOAD');
        }
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
