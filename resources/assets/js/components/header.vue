<template>
    <div>
        <header>
            <div class="row top-status-bar">
                <i class="fa fa-circle"></i>
                <span class="dropdown">
                    <span v-if="batteryFirst" class="dropdown-toggle" data-toggle="dropdown">
                        P{{ batteryFirst.pod_id }}/{{ batteryFirst.pod_side }}:
                        <i v-if="batteryFirst.status.parsed.status.internal_batter_level.gopro_subid === 1" class="fa fa-battery-quarter" aria-hidden="true"></i>
                        <i v-if="batteryFirst.status.parsed.status.internal_batter_level.gopro_subid === 2" class="fa fa-battery-half" aria-hidden="true"></i>
                        <i v-if="batteryFirst.status.parsed.status.internal_batter_level.gopro_subid === 3" class="fa fa-battery-full" aria-hidden="true"></i>
                        <i v-if="batteryFirst.status.parsed.status.internal_batter_level.gopro_subid === 4" class="fa fa-bolt" aria-hidden="true"></i>
                    </span>
                    <ul class="dropdown-menu">
                        <li v-for="battery in batterySort">
                            <a v-if="battery.status.parsed.status.internal_batter_level.gopro_subid === 1">P{{ battery.pod_id }}/{{ battery.pod_side }}: <i class="fa fa-battery-quarter" aria-hidden="true"></i></a>
                            <a v-if="battery.status.parsed.status.internal_batter_level.gopro_subid === 2">P{{ battery.pod_id }}/{{ battery.pod_side }}: <i class="fa fa-battery-half" aria-hidden="true"></i></a>
                            <a v-if="battery.status.parsed.status.internal_batter_level.gopro_subid === 3">P{{ battery.pod_id }}/{{ battery.pod_side }}: <i class="fa fa-battery-full" aria-hidden="true"></i></a>
                            <a v-if="battery.status.parsed.status.internal_batter_level.gopro_subid === 4">P{{ battery.pod_id }}/{{ battery.pod_side }}: <i class="fa fa-bolt" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </span>
                <span class="dropdown">
                    <span v-if="durationFirst" class="dropdown-toggle" data-toggle="dropdown">
                        P{{ durationFirst.pod_id }}/{{ durationFirst.pod_side }}: {{ durationFirst.status.parsed.status.remaining_video_duration.value | secondsToHours }} hours
                    </span>
                    <ul class="dropdown-menu">
                        <li v-for="duration in durationSort">
                            <a>P{{ duration.pod_id }}/{{ duration.pod_side }}: {{ duration.status.parsed.status.remaining_video_duration.value | secondsToHours }} hours</a>
                        </li>
                    </ul>
                </span>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb pod-ordered-list">
                        <li class="list-item">
                            <router-link :to="{ name: 'home' }">All</router-link>
                        </li>

                        <li v-if="!podRoute && !camRoute" v-for="pod in pods" class="list-item">
                            <router-link :to="{ name: 'pod', params: { pod_id: pod.id } }">{{ pod.name }}</router-link>
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
            cameras : function() {
                return this.$root.shared.cameras;
            },
            durationSort : function() {
                return this.sort('status.parsed.status.remaining_video_duration.value');
            },
            durationFirst : function() {
                return _.first(this.durationSort);
            },
            batterySort : function() {
                return this.sort('status.parsed.status.internal_batter_level.gopro_subid');
            },
            batteryFirst : function() {
                return _.first(this.batterySort);
            },
            podId : function() {
                return this.$route.params.pod_id;
            },
            camId : function() {
                return this.$route.params.cam_id;
            },
            podRoute : function() {
                return this.$route.name === 'pod';
            },
            camRoute : function() {
                return this.$route.name === 'camera';
            }
        },
        data() {
            return {
                pods: [],
                recordingStatus: 0
            }
        },
        methods: {
            sort : function(key, order) {
                if(typeof order === 'undefined') {
                    order = 'asc'
                }
                return _.orderBy(this.cameras, [key], [order]);
            }
        },
        filters: {
            secondsToHours : function(value) {
                return moment.duration(value, 'seconds').asHours().toFixed(2);
            }
        }
    }
</script>

<style lang="sass">
    .top-status-bar
        padding: 0.25em
        text-align: center
        i
            margin-right: 100px
            &.fa-circle
                color: green
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
</style>
