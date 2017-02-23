<template>
    <div>
        <jism-layout-primary>
            <h1>Pods</h1>
            <ul class="list-group">
                <li v-for="pod in pods" class="list-group-item">{{ pod.pod_id }}</li>
                <li v-if="!pods.length" class="list-group-item">
                    <router-link :to="{ name: 'add' }">ADD SOME PODS, YO</router-link>
                </li>
            </ul>

            <h1>Cameras</h1>
            <ul class="list-group">
                <li v-for="camera in cameras" class="list-group-item">
                    <router-link :to="{ name: 'add' }">
                        {{ camera.ssid }}: <span v-if="camera.pod_id">{{ camera.pod_id }}/</span>{{ camera.pod_side }}
                    </router-link>
                </li>
                <li v-if="!cameras.length" class="list-group-item">
                    NO CAMERAS DETECTED
                </li>
            </ul>
        </jism-layout-primary>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                pods: [],
                cameras: [],
            }
        },
        methods: {
            getAvailableCameras : function() {
                axios.get('/api/group/1/status').then((response) => {
                        this.cameras = response.data;
                    }, (error) => {
                        console.log(error.response.data);
                    });
            }
        },
        created() {
            this.getAvailableCameras();
        }
    }
</script>

<style lang="sass" scoped>

</style>
