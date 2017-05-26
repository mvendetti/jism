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

            // console.log(state.pods);
            //
            //
            // state.all = Jism.massMergeModels(state.all, data);
            // console.log(Jism.massMergeModels(state.all, [data]));
            // state.all = data;
        },
    },
    getters: {
        pods: state => {
            return state.pods;
        },
        pod: state => number => {
            return _.find(state.pods, function(elem) { return elem.number == number; });
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
