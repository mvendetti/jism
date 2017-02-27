<template>
    <div>
        <jism-layout-primary>
            <h1>New Pod</h1>
            <div class="form-group">
                <select v-model="podId" class="form-control">
                    <option v-for="n in 10">{{ n }}</option>
                </select>
            </div>
            <h3>Cameras</h3>
            <ul class="list-group">
                <li v-for="camera in cameras" class="list-group-item">
                    <span v-if="cameras.online">{{ camera.ssid }}: {{ camera.pod_side }}</span>
                    <span v-else>{{ camera.ssid }}: Camera Offline</span>
                </li>
                <li v-if="!cameras.length" class="list-group-item">No cameras detected</li>
            </ul>
            <button @click.prevent="addPod" class="btn btn-primary">Add</button>
        </jism-layout-primary>
    </div>
</template>

<script>
    export default {
        computed: {
            cameras : function() {
                return this.$root.shared.cameras;
            },
        },
        data() {
            return {
                pods: [],
                podId: 1
            }
        },
        methods: {
            addPod : function() {
                const data = {
                    'pod_id' : this.podId
                };
                axios.post('/api/pod', data).then((response) => {
                    console.log(response.data);
                }, (error) => {
                    console.log(error.response.data);
                });
            }
        }
    }
</script>

<style lang="sass" scoped>

</style>
