const obj = {
    namespaced: true,
    state: { all: [] },
    actions: {
        RECORD: function ({ commit, state }, form) {
            return Jism.post('/api/group/1/record', form);
        },
        STOP: function ({ commit, state }, form) {
            return Jism.post('/api/group/1/stop', form);
        },
        SLEEP: function ({ commit, state }, form) {
            return Jism.post('/api/group/1/sleep', form);
        },
        WAKE: function ({ commit, state }, form) {
            return Jism.post('/api/group/1/wake', form);
        },
    },
    mutations: {
        RECORD: (state, { data }) => {
            //
        },
    },
    getters: {
        all: state => {
            return state.all;
        },
    }
};
export default obj;
