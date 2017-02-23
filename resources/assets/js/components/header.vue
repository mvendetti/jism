<template>
    <div>
        <header>
            <div class="row top-status-bar">
                <i class="fa fa-circle"></i>
                <i class="fa fa-battery-full" aria-hidden="true"></i>
                <span>0:00</span>
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
            podId : function() {
                return this.$route.params.pod_id;
            },
            camId : function() {
                return this.$route.params.cam_id;
            },
            podRoute : function() {
                return this.$route.name === 'pod'
            },
            camRoute : function() {
                return this.$route.name === 'camera'
            }
        },
        data() {
            return {
                pods: [],
                batteryLevel: '',
                videoDuration: 0,
                recordingStatus: 0
            }
        },
        methods: {
            status : function() {
                axios.get('/api/pod/123/status').then((response) => {
                        console.log(response.data);
                    }, (error) => {
                        console.log(error.response.data);
                    });
            }
        },
        created() {
            // this.status();
        }
    }
</script>

<style lang="sass" scoped>
    .top-status-bar
        padding: 0.25em
        text-align: center
        i
            margin-right: 100px;
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
