<template>
    <div>
        <h1>Create Pod</h1>
        <div class="form-group">
            <jism-form-dropdown
                v-model="form.number"
                v-bind:hasError="form.errors.has('number')"
                v-bind:errorMsg="form.errors.get('number')"
                v-bind:options="values"
            ></jism-form-dropdown>
            <button
                type="submit"
                class="btn btn-primary btn-block"
                :disabled="form.busy"
                @click="submit"
            >Create</button>
        </div>
        <div class="panel-body" v-show="form.errors.hasUnreadErrors()">
            <div class="alert alert-danger" role="alert" v-for="error in form.errors.flattenUnread()">{{ error }}</div>
        </div>

        <h3>Assign</h3>
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
                                :selected="camera.pod_side"
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
                                :selected="camera.pod_side"
                            >
                                {{ camera.ssid }}
                            </option>
                        </select>
                    </div>
                </div>
            </li>
            <li v-if="!pods.length" class="list-group-item">No pods added</li>
        </ul>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    export default {
        computed: {
            ...mapGetters('landlord', ['status', 'pods', 'cameras']),
            values() {
                var vals = [];

                _.forEach(_.range(1, 6), (value) => {
                    vals.push({ value: value, title: value });
                });
                return vals;
            },
            set_cameras() {
                var arr = [];

                _.forEach(this.status, (val) => {
                    console.log(val);
                });

                return arr;
            },
            other_cameras() {
                //
            },
            merged_cameras() {
                return _.merge()
            },
        },
        data() {
            return {
                form: new JismForm({
                    number: null,
                })
            }
        },
        methods: {
            submit() {
                this.$emit('submit', this.form);
            },
            assignCameraToPod(pod, side, event) {
                if(event.target.value === 'unassign') {
                    this.unassignCameraFromPod(event.target.value)
                    return false;
                }
                var camera_id = `${event.target.value}`,
                    data = {
                        'pod_id': pod.id,
                        'pod_side': side
                    };
                axios.patch('/api/camera/' + camera_id, data).then((response) => {
                    console.log(response.data);
                }, (error) => {
                    console.log(error.response.data);
                });
            },
            unassignCameraFromPod(camera_id) {
                axios.delete('/api/camera/' + camera_id).then((response) => {
                    console.log(response.data);
                }, (error) => {
                    console.log(error.response.data);
                });
            }
        },
    }
</script>
