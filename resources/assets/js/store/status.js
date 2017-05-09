const obj = {
    namespaced: true,
    state: { all: [] },
    actions: {
        LOAD: function ({ commit }) {
            return Jism.get('/api/group/1/status', 'status/LOAD');
        },
    },
    mutations: {
        LOAD: (state, { data }) => {
            state.all = data;
            setTimeout(() => {
                    Jism.Vue.$store.dispatch('status/LOAD')
                }, 2500);
        },
    },
    getters: {
        all: state => {
            return state.all;
        },
        find: state => pod_id => pod_side => {
            return _.find(state.all, function(elem) { return elem.pod_id == pod_id && elem.pod_side == pod_side; });
        },
        online: state => {
            var e = _.first(_.orderBy(state.all, ['online'], ['asc']));

            if(e !== undefined) {
                return e.online;
            }
            return 0;
        },
        videoDuration: state => {
            var e = _.first(_.orderBy(state.all, ['status.parsed.status.remaining_video_duration.value'], ['asc']));

            if(e !== undefined) {
                return e.status.parsed.status.remaining_video_duration.value;
            }
            return 0;
        },
        batteryDuration: state => {
            var e = _.first(_.orderBy(state.all, ['status.parsed.status.internal_battery_level.gopro_subid'], ['asc']));

            if(e !== undefined) {
                return e.status.parsed.status.internal_battery_level.gopro_subid;
            }
            return 0;
        },
    }
};
export default obj;
