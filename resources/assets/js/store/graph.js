const obj = {
    namespaced: true,
    state: { all: [] },
    actions: {
        LOAD: function ({ commit }) {
            return Jism.get('/api/graph', 'graph/LOAD');
        }
    },
    mutations: {
        LOAD: (state, { data }) => {
            state.all = data;
        },
    },
    getters: {
        pods: state => {
            return state.all.pods;
        },
        pod: state => number => {
            return _.find(state.all.pods, function(elem) { return elem.number == number; });
        },
        cameras: state => {
            return state.all.cameras;
        },
        camera: state => serial_number => {
            return _.find(state.all.cameras, function(elem) { return elem.serial_number == serial_number; });
        },
    }
};
export default obj;
