<template>
    <div>
        <jism-layout-primary>
            <h1>New Pod</h1>
            <form @submit.prevent="addPod" >
                <div :class="['form-group', errorPod ? 'has-error' : '']">
                    <select v-model="podNumber" class="form-control">
                        <option v-for="n in 5">{{ n }}</option>
                    </select>
                    <p v-for="error in errors.number" class="error-message">{{ error }}</p><p></p>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
            <h3>Pods</h3>
            <ul class="list-group">
                <li v-for="pod in pods" class="list-group-item">
                    <div class="row">
                        <div class="col-xs-2 col-md-2">
                            <strong>P{{ pod.number }}</strong>
                        </div>
                        <div class="col-xs-5 col-md-5">
                            <select class="form-control" @change="assignCameraToPod(pod, 'left', $event)">
                                <option value="">unassigned</option>
                                <option
                                    v-for="camera in cameras"
                                    :value="camera.serial_number"
                                    :selected="camera.serial_number == pod.camera_left_id"
                                >
                                {{ camera.ssid }}
                                </option>
                            </select>
                        </div>
                        <div class="col-xs-5 col-md-5">
                            <select class="form-control" @change="assignCameraToPod(pod, 'right', $event)">
                                <option value="">unassigned</option>
                                <option
                                    v-for="camera in cameras"
                                    :value="camera.serial_number"
                                    :selected="camera.serial_number == pod.camera_right_id"
                                >
                                {{ camera.ssid }}
                            </option>
                            </select>
                        </div>
                    </div>
                </li>
                <li v-if="!pods.length" class="list-group-item">No pods added</li>
            </ul>
        </jism-layout-primary>
    </div>
</template>

<script>
    export default {
        computed: {
            cameras() {
                return this.$root.shared.cameras;
            },
            pods() {
                return _.orderBy(this.$root.shared.pods, 'number', ['asc']);
            },
            errorPod() {
                return this.hasError('number');
            }
        },
        data() {
            return {
                errors: {},
                podNumber: 1
            }
        },
        methods: {
            addPod() {
                var data = {
                    'number': this.podNumber
                };
                axios.post('/api/pod', data).then((response) => {
                    //
                }, (error) => {
                    this.errors = error.response.data;
                });
            },
            assignCameraToPod(pod, side, event) {
                var camera_id = `${event.target.value}`;
                pod['camera_' + side + '_id'] = camera_id;
                axios.patch('/api/pod/' + pod.id, pod).then((response) => {
                    console.log(response.data);
                }, (error) => {
                    this.errors = error.response.data;
                });
            },
            hasError(field) {
                if(typeof this.errors[field] != 'undefined' && this.errors[field].length > 0)
                {
                    return true;
                }
                return false;
            }
        }
    }
</script>
