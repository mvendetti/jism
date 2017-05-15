<template>
    <div>
        <h1>Pod</h1>
        <div class="form-group">
            <jism-form-dropdown
                v-model="form.number"
                v-bind:hasError="form.errors.has('number')"
                v-bind:errorMsg="form.errors.get('number')"
                v-bind:options="form.options"
            ></jism-form-dropdown>
            <button
                type="submit"
                class="btn btn-primary btn-block"
                :disabled="form.busy"
                @click="submit"
            >Create</button>
            <button
                type="submit"
                class="btn btn-danger btn-block"
                v-if="editMode"
                :disabled="form.busy"
                @click="confirmDelete"
            >Delete</button>
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
        <!-- <vudal name="confirmDeleteModal">
            <div class="header">
                <i class="close icon"></i>
                Are you sure you wish to delete the pod: {{ form.number }}?
            </div>
            <div class="actions">
                <div class="btn btn-danger pull-left ui button" @click="confirmedDelete">Yes, Delete</div>
                <div class="btn btn-primary cancel">Cancel</div>
            </div>
        </vudal> -->
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import Vudal from 'vudal';
    export default {
        computed: mapGetters('landlord', ['pods', 'cameras']),
        components: { Vudal },
        data() {
            return {
                editMode: false,
                form: new JismForm({
                    number: null,
                    options: [ '1', '2', '3', '4', '5'],
                })
            }
        },
        methods: {
            confirmDelete() {
                this.$modals.confirmDeleteModal.$show();
            },
            confirmedDelete() {
                this.$emit('delete', this.item);
                this.$modals.confirmDeleteModal.$hide();
            },
            submit() {
                this.$emit('submit', this.form);
            },
            assignCameraToPod(pod, side, event) {
                var camera_id = `${event.target.value}`;
                pod['camera_' + side + '_id'] = camera_id;
                axios.patch('/api/pod/' + pod.id, pod).then((response) => {
                    console.log(response.data);
                }, (error) => {
                    this.errors = error.response.data;
                });
            }
        },
        created() {
            if(this.item) {
                var that = this;
                _.forEach(this.form.getOriginalData(), function(value, key) {
                    if(that.item[key]) {
                        that.form[key] = that.item[key];
                    }
                });
                this.editMode = true;
            }
        }
    }
</script>
