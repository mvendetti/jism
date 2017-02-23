<template>
    <div>
        <jism-layout-primary>
            <h1>Pods</h1>
            <ul class="list-group">
                <li v-for="pod in pods" class="list-group-item">{{ pod }}</li>
                <li v-if="!pods.length" class="list-group-item">
                    <router-link :to="{ name: 'add' }">ADD SOME PODS, YO</router-link>
                </li>
            </ul>

            <h1>Cameras</h1>
            <ul class="list-group">
                <li v-for="camera in cameras" class="list-group-item">
                    <router-link :to="{ name: 'add' }">{{ camera.ssid }}: {{ camera.pod_side }}</router-link>
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
                axios.get('/api/camera/123/status').then((response) => {
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
