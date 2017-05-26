const landlord = {
    namespaced: true,
    state: {
        group_id: 1,
        pod_number: null,
        camera_id: null,
    },
    actions: {
        UPDATE: function ({ commit, state }, route) {
            Jism.Vue.$store.dispatch('keys/LOAD');
            commit('STORE_POD_NUMBER', route.params.pod_number);
            commit('STORE_CAMERA_ID', route.params.camera_id);
        },
    },
    mutations: {
        STORE_POD_NUMBER: (state, id) => {
            state.pod_number = id;
        },
        STORE_CAMERA_ID: (state, id) => {
            state.camera_id = id;
        }
    },
    getters: {
        status: state => {
            var cameras = _.filter(Jism.vuexGet('graph/cameras'), (elem) => {
                if(state.pod_id && state.camera_id) {
                    return elem.pod_id == state.pod_id && elem.pod_side == state.camera_id;
                }
                if(state.pod_id) {
                    return elem.pod_id == state.pod_id;
                }
                return true;
            });

            return _.map(cameras, (camera) => {
                return camera.status;
            });
        },
        pods: state => {
            return _.orderBy(Jism.vuexGet('graph/pods'), ['number'], ['asc']);
        },
        pod: state => {
            return Jism.vuexGet('pod/find', state.pod_id);
        },
        cameras: state => {
            return Jism.vuexGet('graph/cameras');
        },
        camera: state => serial_number => {
            return Jism.vuexGet('graph/camera', serial_number);
        },
        online: state => {
            var cameras = Jism.vuexGet('graph/cameras'),
                online = [];

            _.each(cameras, (camera) => {
                if(camera.online === true) {
                    online.push(camera.serial_number)
                }
            });
            return online;
        },
        onlineCount: state => {
            return _.size(Jism.vuexGet('landlord/online'));
        },
        allOnline: state => {
            var onlineCount = Jism.vuexGet('landlord/onlineCount'),
                totalCount = _.size(Jism.vuexGet('graph/cameras'));
            return onlineCount == totalCount && totalCount > 0;
        },
        batteryDurations: state => {
            var stati = Jism.vuexGet('landlord/status'),
                battery_level_path = 'parsed.status.internal_battery_level.gopro_subid',
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
                remaining_video_path = 'parsed.status.remaining_video_duration.value',
                current_video_path = 'parsed.status.current_video_duration.value',
                ordered = _.orderBy(stati, [remaining_video_path], ['asc']);

            return _.map(ordered, (elem) => {
                var current_video_duration = _.result(elem, current_video_path),
                    remaining_video_duration = _.result(elem, remaining_video_path);

                remaining_video_duration = remaining_video_duration - current_video_duration;

                return {
                    'pod_number': elem.pod_number,
                    'pod_side': elem.pod_side,
                    'serial_number': elem.serial_number,
                    'duration': remaining_video_duration
                }
            });
        },
        videoDuration: state => {
            return _.first(Jism.vuexGet('landlord/videoDurations'));
        },
        keys: state => {
            return Jism.vuexGet('keys/all');
        },
    }
};
export default landlord;
