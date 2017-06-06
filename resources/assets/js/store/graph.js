const obj = {
    namespaced: true,
    state: {
        pods : [],
        cameras : []
    },
    actions: {
        LOAD: function ({ commit }) {
            return Jism.get('/api/graph', 'graph/LOAD');
        }
    },
    mutations: {
        LOAD: (state, { data }) => {
            state.pods = Jism.massMergeModels(state.pods, data.pods);
            state.cameras = Jism.massMergeModels(state.cameras, data.cameras, 'serial_number');
        },
    },
    getters: {
        pods: state => {
            return state.pods;
        },
        pod: state => pod_id => {
            return _.find(state.pods, function(elem) { return elem.id == pod_id; });
        },
        cameras: state => {
            return state.cameras;
        },
        camera: state => serial_number => {
            return _.find(state.cameras, function(elem) { return elem.serial_number == serial_number; });
        },
    }
};
export default obj;
