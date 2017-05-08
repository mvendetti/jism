<template>
    <div>
        <header>
            <div class="row top-status-bar">
                <jism-header-status></jism-header-status>
                <jism-header-battery></jism-header-battery>
                <jism-header-timer></jism-header-timer>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb pod-ordered-list">
                        <li class="list-item">
                            <router-link :to="{ name: 'home' }">All</router-link>
                        </li>

                        <li v-if="!podRoute && !camRoute" v-for="pod in pods" class="list-item">
                            <router-link :to="{ name: 'pod', params: { pod_id: pod.number } }">P{{ pod.number }}</router-link>
                        </li>

                        <li v-if="podRoute || camRoute" class="list-item">
                            <router-link :to="{ name: 'pod' }">P{{ this.podId }}</router-link>
                        </li>

                        <li v-if="podRoute || camRoute" class="list-item">
                            <router-link v-if="this.camId !== 'left'" :to="{ name: 'camera', params: { pod_id: this.podId, cam_id: 'left' } }">Left</router-link>
                            <span v-if="this.camId === 'left'">Left</span>
                        </li>

                        <li v-if="podRoute || camRoute" class="list-item">
                            <router-link v-if="this.camId !== 'right'" :to="{ name: 'camera', params: { pod_id: this.podId, cam_id: 'right' } }">Right</router-link>
                            <span v-if="this.camId === 'right'">Right</span>
                        </li>
                    </ol>
                </div>
            </div>
        </header>
    </div>
</template>

<script>
    export default {
        computed: {
            cameras() {
                return this.$root.shared.cameras;
            },
            pods() {
                return _.orderBy(this.$root.shared.pods, 'number', ['asc']);
            },
            batterySort() {
                return this.sort('status.parsed.status.internal_battery_level.gopro_subid');
            },
            batteryFirst() {
                return _.first(this.batterySort);
            },
            podId() {
                return this.$route.params.pod_id;
            },
            camId() {
                return this.$route.params.cam_id;
            },
            podRoute() {
                return this.$route.name === 'pod';
            },
            camRoute() {
                return this.$route.name === 'camera';
            }
        },
        methods: {
            sort(key, order) {
                if(typeof order === 'undefined') {
                    order = 'asc';
                }
                return _.orderBy(this.cameras, [key], [order]);
            },
            is_recording(callback) {
                axios.get('/api/group/1/status').then((response) => {
                    var isRecording = response.data.is_recording;
                    if(isRecording) {
                        var self = this;
                        setTimeout(function() {
                            self.is_recording(callback);
                        }, 5000);
                    } else {
                        this.isRecording = false
                        // change status icon
                        return false;
                    }
                }, (error) => {
                    console.log(error.response.data);
                });
            },
            idle_perfect() {
                _.forEach(this.cameras, function(value, key) {
                    var isOnline = value.online,
                        hasSdCard = value.status.parsed.status.card_inserted.value,
                        timeLeft = value.status.parsed.status.remaining_video_duration.value,
                        hasBattery = value.status.parsed.status.internal_battery.value,
                        batteryLeft = value.status.parsed.status.internal_battery_level.value;
                });
            },
            idle_update() {
                axios.get('/api/group/1/status').then((response) => {
                    var timestamp = response.data;
                }, (error) => {
                    console.log(error.response.data);
                });
            },
            startRecording() {
                axios.post('/api/group/1/record').then((response) => {
                    //
                }, (error) => {
                    console.log(error.response.data);
                });
            }
        }
    };
</script>

<style lang="sass">
    .top-status-bar
        padding: 0.25em
        text-align: center
        i
            margin-right: 75px
            &.green
                color: #6AA84F
            &.red
                color: #CC0000
            &.yellow
                color: #FFD966
            &.gray
                color: #CCCCCC
        button
            border: none
            background-color: transparent
    .pod-ordered-list
        border-radius: 0
        border-top: 1px solid #222
        border-bottom: 1px solid #222
        background-color: #e2e2e2
        padding: 0.75em
        li
            &::before
                padding: 0 15px
            a
                &.active
                    color: #777
                &:hover, &:focus
                    text-decoration: none
        .list-item
            font-weight: 900
            font-size: 1.1em
    .dropdown-menu
        &.duration
            left: auto
            right: 0
            float: right
</style>
