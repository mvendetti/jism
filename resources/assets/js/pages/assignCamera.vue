<template>
    <div>
        <jism-layout-primary>
            <h1>Pods</h1>
            <ul class="list-group">
                <li v-for="pod in pods" class="list-group-item">P{{ pod.pod_id }}</li>
                <li v-if="!pods.length" class="list-group-item">
                    <router-link :to="{ name: 'add' }">Add pod here</router-link>
                </li>
            </ul>

            <h1>Cameras</h1>
            <ul class="list-group">
                <li v-for="camera in cameras" class="list-group-item">
                    <router-link v-if="camera.online" :to="{ name: 'add' }">
                        {{ camera.ssid }}: <span v-if="camera.pod_id">P{{ camera.pod_id }}/</span>{{ camera.pod_side }}
                    </router-link>
                    <router-link v-else :to="{ name: 'settings' }">
                        <span>{{ camera.ssid }}: Camera Offline</span>
                    </router-link>
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
