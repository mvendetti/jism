const landlord = {
    namespaced: true,
    state: {
        group_id: 1,
        pod_id: null,
        camera_id: null,
    },
    actions: {
        UPDATE: function ({ commit, state }, route) {
            commit('STORE_POD_ID', route.params.pod_id);
            commit('STORE_CAMERA_ID', route.params.camera_id);
        },
    },
    mutations: {
        STORE_POD_ID: (state, id) => {
            state.pod_id = id;
        },
        STORE_CAMERA_ID: (state, id) => {
            state.camera_id = id;
        },
    },
    getters: {
        status: state => {
            return _.filter( Jism.vuexGet('status/all') , function(elem) {
                if(state.pod_id && state.camera_id) {
                    return elem.pod_id == state.pod_id && elem.pod_side == state.camera_id;
                }
                if(state.pod_id) {
                    return elem.pod_id == state.pod_id;
                }
                return true;
            });
        },
        videoDurations: state => {
            var stati = Jism.vuexGet('landlord/status'),
                path = 'status.parsed.status.remaining_video_duration.value',
                ordered = _.orderBy(stati, [path], ['asc']);

            return _.map(ordered, (elem) => {
                var current_video_duration = _.result(elem, 'status.parsed.status.current_video_duration.value'),
                    remaining_video_duration = _.result(elem, 'status.parsed.status.remaining_video_duration.value');

                remaining_video_duration = remaining_video_duration - current_video_duration;

                return {
                    'pod_id': elem.pod_id,
                    'pod_side': elem.pod_side,
                    'serial_number': elem.serial_number,
                    'duration': remaining_video_duration
                }
            });
        },
        videoDuration: state => {
            return _.first(Jism.vuexGet('landlord/videoDurations'));
        },
    }
};
export default landlord;
