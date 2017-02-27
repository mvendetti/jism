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
                    <router-link v-if="camera.online" :to="{ name: 'add' }">
                        {{ camera.ssid }}: <span v-if="camera.pod_id">{{ camera.pod_id }}/</span>{{ camera.pod_side }}
                    </router-link>
                    <span v-else>{{ camera.ssid }}: Camera Offline</span>
                </li>
                <li v-if="!cameras.length" class="list-group-item">No cameras detected</li>
            </ul>
        </jism-layout-primary>
    </div>
</template>

<script>
    export default {
        computed: {
            cameras : function() {
                return this.$root.shared.cameras;
            }
        },
        data() {
            return {
                pods: []
            }
        }
    }
</script>

<style lang="sass" scoped>

</style>
