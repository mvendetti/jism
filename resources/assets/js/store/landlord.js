const landlord = {
    namespaced: true,
    state: {
        group_id: 1,
        pod_id: null,
        camera_id: null,
    },
    actions: {
        UPDATE: function ({ commit, state }, route) {
            Jism.Vue.$store.dispatch('pod/LOAD');
            Jism.Vue.$store.dispatch('camera/LOAD');
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
        }
    },
    getters: {
        status: state => {
            return _.filter(Jism.vuexGet('status/all'), (elem) => {
                if(state.pod_id && state.camera_id) {
                    return elem.pod_id == state.pod_id && elem.pod_side == state.camera_id;
                }
                if(state.pod_id) {
                    return elem.pod_id == state.pod_id;
                }
                return true;
            });
        },
        pods: state => {
            return _.orderBy(Jism.vuexGet('pod/all'), ['number'], ['asc']);
        },
        pod: state => {
            return Jism.vuexGet('pod/find', state.pod_id);
        },
        cameras: state => {
            return Jism.vuexGet('camera/all');
        },
        online: state => {
            var e = _.first(_.orderBy(state.all, ['online'], ['asc']));

            if(e !== undefined) {
                return e.online;
            }
            return 0;
        },
        batteryDurations: state => {
            var stati = Jism.vuexGet('landlord/status'),
                battery_level_path = 'status.parsed.status.internal_battery_level.gopro_subid',
                ordered = _.orderBy(stati, [battery_level_path], ['asc']);

            return _.map(ordered, (elem) => {
                var battery_level_id = _.result(elem, battery_level_path);

                return {
                    'pod_id': elem.pod_id,
                    'pod_side': elem.pod_side,
                    'serial_number': elem.serial_number,
                    'battery_level_id': battery_level_id
                }
            });
        },
        batteryDuration: state => {
            return _.first(Jism.vuexGet('landlord/batteryDurations'));
        },
        videoDurations: state => {
            var stati = Jism.vuexGet('landlord/status'),
                remaining_video_path = 'status.parsed.status.remaining_video_duration.value',
                current_video_path = 'status.parsed.status.current_video_duration.value',
                ordered = _.orderBy(stati, [remaining_video_path], ['asc']);

            return _.map(ordered, (elem) => {
                var current_video_duration = _.result(elem, current_video_path),
                    remaining_video_duration = _.result(elem, remaining_video_path);

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
