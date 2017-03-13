<template>
    <div>
        <jism-layout-primary>
            <h1>New Pod</h1>
            <div class="form-group">
                <select v-model="podIdSelected" class="form-control">
                    <option v-for="n in 10">{{ n }}</option>
                </select>
            </div>
            <h3>Pods</h3>
            <ul class="list-group">
                <li v-for="pod in pods" class="list-group-item">
                    <span><strong>P{{ pod.pod_id }}:</strong> {{ pod.camera }}</span>
                </li>
                <li v-if="!pods.length" class="list-group-item">No pods added</li>
            </ul>
            <h3>Cameras</h3>
            <ul class="list-group">
                <li v-for="camera in cameras" class="list-group-item">
                    <span v-if="camera.online">
                        {{ camera.ssid }}: {{ camera.pod_side }}
                        <input v-model="cameraSelected" :value="camera.ssid" type="checkbox" class="pull-right" :disabled="isMax(camera.ssid)">
                    </span>
                    <router-link v-else :to="{ name: 'settings' }">
                        <span>{{ camera.ssid }}: Camera Offline</span>
                    </router-link>
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
            }
        },
        data() {
            return {
                pods: [],
                podIdSelected: 1,
                cameraSelected: []
            }
        },
        methods: {
            isMax : function(camera) {
                if(this.cameraSelected.length >= 2 && this.cameraSelected.indexOf(camera) === -1) {
                    return true;
                }
                return false;
            },
            addPod : function() {
                const data = {
                    'pod_id' : this.podIdSelected,
                    'camera' : this.cameraSelected.toString().replace(/,/g , '/')
                };

                this.pods.push(data)
                this.podId = 1

                // axios.post('/api/pod', data).then((response) => {
                //     console.log(response.data);
                // }, (error) => {
                //     console.log(error.response.data);
                // });

            }
        }
    }
</script>

<style lang="sass" scoped>

</style>
