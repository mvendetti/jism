const obj = {
    namespaced: true,
    state: { all: [] },
    actions: {
        RECORD: function ({ commit }) {
            return Jism.post('/api/group/1/record', 'group/RECORD');
        },
        STOP: function ({ commit }) {
            return Jism.post('/api/group/1/stop', 'group/STOP');
        },
    },
    mutations: {
        //
    },
    getters: {
        all: state => {
            return state.all;
        },
        find: state => {
            //
        },
    }
};
export default obj;
