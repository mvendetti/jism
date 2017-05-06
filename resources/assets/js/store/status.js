const obj = {
    namespaced: true,
    state: { all: [] },
    actions: {
        LOAD: function ({ commit }) {
            return Jism.get('/api/group/1/status', 'status/LOAD');
        },
        // STORE: function ({ commit, state }, form) {
        //     return Jism.post('/api/company/:company_id/tenancy/:tenancy_id/domain', form, 'domain/STORE');
        // },
        // UPDATE: function ({ commit, state }, form) {
        //     return Jism.patch('/api/company/:company_id/tenancy/:tenancy_id/domain/:domain_id', form, 'domain/STORE');
        // },
        // DESTROY: function ({ commit, state }, id) {
        //     return Jism.destroy('/api/company/:company_id/tenancy/:tenancy_id/domain/:domain_id', 'domain/DESTROY', id);
        // }
    },
    mutations: {
        LOAD: (state, { data }) => {
            state.all = Jism.massMergeModels(state.all, data);
        },
        STORE: (state, { item }) => {
            state.all = Jism.massMergeModels(state.all, [item]);
        },
        DESTROY: (state, { id }) => {
            state.all = Jism.removeModel(state.all, id);
        },
    },
    getters: {
        all: state => id => {
            return _.filter(state.all, function(elem) { return elem.tenancy_id == id; });
        },
        find: state => id => {
            return _.find(state.all, function(elem) { return elem.id == id; });
        },
        remainingVideoDuration: state => {
            var e = _.first(_.orderBy(state.all, ['status.parsed.status.remaining_video_duration.value'], ['asc']));

            if(e !== undefined) {
                return e.status.parsed.status.remaining_video_duration.value;
            }
            return 0;
        }
    }
};
export default obj;
