<template>
    <div>
        <jism-layout-primary>
            <h1>Camera Settings</h1>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <router-link :to="{ name: 'review' }"><button class="btn btn-primary">Review</button></router-link>
                    <button class="btn btn-default">Flip</button>
                    <button @click="sleep" class="btn btn-default">Sleep</button>
                    <button @click="wake" class="btn btn-default">Wake</button>
                </div>
            </div>
        </jism-layout-primary>
    </div>
</template>

<script>
    export default {
        computed: {
            pod() {
                var pod_id = this.$route.params.pod_id,
                    queryFn = function(pod) { return pod.number == pod_id; };
                return _.find(this.$root.shared.pods, queryFn);
            },
            cameraLeftId() {
                return this.pod.camera_left_id;
            },
            cameraRightId() {
                return this.pod.camera_right_id;
            }
        },
        methods: {
            sleep() {
                var camParam = this.$route.params.cam_id;
                if(camParam === 'left') {
                    this.sleepOrWakePost(this.cameraLeftId, 'sleep');
                } else if(camParam === 'right') {
                    this.sleepOrWakePost(this.cameraRightId, 'sleep');
                }
            },
            wake() {
                //
            },
            sleepOrWakePost(id, state) {
                axios.post('/api/camera/' + id + '/' + state).then((response) => {
                    console.log(response.data);
                }, (error) => {
                    console.log(error.response.data);
                });
            }
        }
    }
</script>
