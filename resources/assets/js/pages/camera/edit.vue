<template>
    <div>
        <jism-layout-primary>
            <h1>Camera {{ this.$route.params.camera_id | capitalize }}</h1>
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
    import { mapGetters } from 'vuex'
    export default {
        computed: {
            ...mapGetters('landlord', ['pods', 'pod']),
            cameraLeftId() {
                return this.pod.camera_left_id;
            },
            cameraRightId() {
                return this.pod.camera_right_id;
            },
            camId() {
                return this.$route.params.camera_id;
            }
        },
        methods: {
            sleep() {
                var sleep = 'sleep';
                if(this.camId === 'left') {
                    this.sleepOrWakePost(this.cameraLeftId, sleep);
                } else if(this.camId === 'right') {
                    this.sleepOrWakePost(this.cameraRightId, sleep);
                }
            },
            wake() {
                var wake = 'wake';
                if(this.camId === 'left') {
                    this.sleepOrWakePost(this.cameraLeftId, wake);
                } else if(this.camId === 'right') {
                    this.sleepOrWakePost(this.cameraRightId, wake)
                }
            },
            sleepOrWakePost(id, state) {
                axios.post('/api/camera/' + id + '/' + state).then((response) => {
                    console.log(response.data);
                }, (error) => {
                    console.log(error.response.data);
                });
            }
        },
        filters: {
            capitalize(string) { return _.capitalize(string); }
        }
    }
</script>
