const obj = {
    namespaced: true,
    state: { all: [] },
    actions: {
        LOAD: function ({ commit }) {
            return Jism.get('/api/camera', 'camera/LOAD');
        }
    },
    mutations: {
        LOAD: (state, { data }) => {
            state.all = Jism.massMergeModels(state.all, data);
        }
    },
    getters: {
        all: state => {
            return state.all;
        },
        find: state => serial_number => {
            return _.find(state.all, function(elem) { return elem.serial_number == serial_number; });
        },
    }
};
export default obj;
