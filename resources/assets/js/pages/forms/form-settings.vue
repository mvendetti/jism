<template>
    <div>
        <h1>Settings</h1>
        <div class="form-group">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <button @click.prevent="sleep" class="btn btn-default">Sleep</button>
                    <button @click.prevent="wake" class="btn btn-default">Wake</button>
                    <button class="btn btn-primary pull-right">Take Images</button>
                </div>
            </div>
        </div>
        <hr />
        <div class="form-group" v-if="keys">
            <div class="row">
                <div class="col-md-4 col-xs-4">
                    <jism-form-dropdown
                        v-if="keys.current_sub_mode_video"
                        v-model="form.current_sub_mode_video"
                        v-bind:hasError="form.errors.has('current_sub_mode_video')"
                        v-bind:errorMsg="form.errors.get('current_sub_mode_video')"
                        v-bind:selected="0"
                        label="Type"
                        v-bind:options="current_sub_mode_video"
                    ></jism-form-dropdown>
                </div>
                <div class="col-md-4 col-xs-4">
                    <jism-form-dropdown
                        v-if="keys.protune"
                        v-model="form.protune"
                        v-bind:hasError="form.errors.has('protune')"
                        v-bind:errorMsg="form.errors.get('protune')"
                        v-bind:selected="1"
                        label="Protune"
                        v-bind:options="protune"
                    ></jism-form-dropdown>
                </div>
                <div class="col-md-4 col-xs-4">
                    <jism-form-dropdown
                        v-if="keys.video_format"
                        v-model="form.video_format"
                        v-bind:hasError="form.errors.has('video_format')"
                        v-bind:errorMsg="form.errors.get('video_format')"
                        v-bind:selected="0"
                        label="Format"
                        v-bind:options="video_format"
                    ></jism-form-dropdown>
                </div>
            </div>
        </div>
        <hr />
        <div class="form-group">
            <div class="row">
                <div class="col-md-6 col-xs-6">
                    <jism-form-dropdown
                        v-if="keys.video_resolution"
                        v-model="form.video_resolution"
                        v-bind:hasError="form.errors.has('video_resolution')"
                        v-bind:errorMsg="form.errors.get('video_resolution')"
                        v-bind:selected="1"
                        label="Resolution"
                        v-bind:options="video_resolution"
                    ></jism-form-dropdown>

                    <jism-form-dropdown
                        v-if="keys.frame_rate"
                        v-model="form.frame_rate"
                        v-bind:hasError="form.errors.has('frame_rate')"
                        v-bind:errorMsg="form.errors.get('frame_rate')"
                        v-bind:selected="8"
                        label="FPS"
                        v-bind:options="frame_rate"
                    ></jism-form-dropdown>

                    <jism-form-dropdown
                        v-if="keys.fov_video"
                        v-model="form.fov_video"
                        v-bind:hasError="form.errors.has('fov_video')"
                        v-bind:errorMsg="form.errors.get('fov_video')"
                        v-bind:selected="0"
                        label="FOV"
                        v-bind:options="fov_video"
                    ></jism-form-dropdown>

                    <jism-form-dropdown
                        v-if="keys.white_balance"
                        v-model="form.white_balance"
                        v-bind:hasError="form.errors.has('white_balance')"
                        v-bind:errorMsg="form.errors.get('white_balance')"
                        v-bind:selected="2"
                        label="White Balance"
                        v-bind:options="white_balance"
                    ></jism-form-dropdown>

                    <jism-form-dropdown
                        v-if="keys.color"
                        v-model="form.color"
                        v-bind:hasError="form.errors.has('color')"
                        v-bind:errorMsg="form.errors.get('color')"
                        v-bind:selected="1"
                        label="Color Profile"
                        v-bind:options="color"
                    ></jism-form-dropdown>
                </div>

                <div class="col-md-6 col-xs-6">
                    <jism-form-dropdown
                        v-if="keys.manual_exposure"
                        v-model="form.manual_exposure"
                        v-bind:hasError="form.errors.has('manual_exposure')"
                        v-bind:errorMsg="form.errors.get('manual_exposure')"
                        v-bind:selected="13"
                        label="Manual Exposure"
                        v-bind:options="manual_exposure"
                    ></jism-form-dropdown>

                    <jism-form-dropdown
                        v-if="keys.iso_limit"
                        v-model="form.iso_limit"
                        v-bind:hasError="form.errors.has('iso_limit')"
                        v-bind:errorMsg="form.errors.get('iso_limit')"
                        v-bind:selected="3"
                        label="ISO"
                        v-bind:options="iso_limit"
                    ></jism-form-dropdown>

                    <jism-form-dropdown
                        v-if="keys.sharpness"
                        v-model="form.sharpness"
                        v-bind:hasError="form.errors.has('sharpness')"
                        v-bind:errorMsg="form.errors.get('sharpness')"
                        v-bind:selected="1"
                        label="Sharpness"
                        v-bind:options="sharpness"
                    ></jism-form-dropdown>

                    <jism-form-dropdown
                        v-if="keys.ev_comp"
                        v-model="form.ev_comp"
                        v-bind:hasError="form.errors.has('ev_comp')"
                        v-bind:errorMsg="form.errors.get('ev_comp')"
                        v-bind:selected="4"
                        label="EV Comp"
                        v-bind:options="ev_comp"
                    ></jism-form-dropdown>

                    <jism-form-dropdown
                        v-if="keys.orientation"
                        v-model="form.orientation"
                        v-bind:hasError="form.errors.has('orientation')"
                        v-bind:errorMsg="form.errors.get('orientation')"
                        v-bind:selected="1"
                        label="Orientation"
                        v-bind:options="orientation"
                    ></jism-form-dropdown>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button @click="submit" class="btn btn-primary btn-block save-button">Save</button>
                </div>
                <div class="col-md-1 col-xs-1">
                    <button @click="format" class="btn btn-danger format-button">FORMAT</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    export default {
        computed: {
            ...mapGetters('landlord', ['keys', 'pods', 'cameras']),
            current_sub_mode_video() {
                var opts = [];
                _.forEach(this.keys.current_sub_mode_video.opts, (value) => {
                    opts.push({ value: value.id, title: value.title });
                });
                return opts;
            },
            protune() {
                var opts = [];
                _.forEach(this.keys.protune.opts, (value) => {
                    opts.push({ value: value.id, title: value.title });
                });
                return opts;
            },
            video_format() {
                var opts = [];
                _.forEach(this.keys.video_format.opts, (value) => {
                    opts.push({ value: value.id, title: value.title });
                });
                return opts;
            },
            video_resolution() {
                var opts = [];
                _.forEach(this.keys.video_resolution.opts, (value) => {
                    opts.push({ value: value.id, title: value.title });
                });
                return opts;
            },
            frame_rate() {
                var opts = [];
                _.forEach(this.keys.frame_rate.opts, (value) => {
                    opts.push({ value: value.id, title: value.title });
                });
                return opts;
            },
            fov_video() {
                var opts = [];
                _.forEach(this.keys.fov_video.opts, (value) => {
                    opts.push({ value: value.id, title: value.title });
                });
                return opts;
            },
            white_balance() {
                var opts = [];
                _.forEach(this.keys.white_balance.opts, (value) => {
                    opts.push({ value: value.id, title: value.title });
                });
                return opts;
            },
            color() {
                var opts = [];
                _.forEach(this.keys.color.opts, (value) => {
                    opts.push({ value: value.id, title: value.title });
                });
                return opts;
            },
            manual_exposure() {
                var opts = [];
                _.forEach(this.keys.manual_exposure.opts, (value) => {
                    opts.push({ value: value.id, title: value.title });
                });
                return opts;
            },
            iso_limit() {
                var opts = [];
                _.forEach(this.keys.iso_limit.opts, (value) => {
                    opts.push({ value: value.id, title: value.title });
                });
                return opts;
            },
            sharpness() {
                var opts = [];
                _.forEach(this.keys.sharpness.opts, (value) => {
                    opts.push({ value: value.id, title: value.title });
                });
                return opts;
            },
            ev_comp() {
                var opts = [];
                _.forEach(this.keys.ev_comp.opts, (value) => {
                    opts.push({ value: value.id, title: value.title });
                });
                return opts;
            },
            orientation() {
                var opts = [];
                _.forEach(this.keys.orientation.opts, (value) => {
                    opts.push({ value: value.id, title: value.title });
                });
                return opts;
            },
        },
        data() {
            return {
                form: new JismForm({
                    current_sub_mode_video: null,
                    protune: null,
                    video_format: null,
                    video_resolution: null,
                    manual_exposure: null,
                    frame_rate: null,
                    iso_limit: null,
                    fov_video: null,
                    sharpness: null,
                    white_balance: null,
                    ev_comp: null,
                    color: null,
                    orientation: null,
                })
            }
        },
        methods: {
            submit() {
                this.$emit('submit', this.form);
            },
            format() {
                //
            }
        },
    }
</script>
