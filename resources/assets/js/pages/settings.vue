<template>
    <div>
        <jism-layout-primary>
            <h1>Settings</h1>
            <div class="form-group">
                <div class="col-md-12 col-xs-12">
                <button @click.prevent="sleep" class="btn btn-default">Sleep</button>
                <button @click.prevent="wake" class="btn btn-default">Wake</button>
                <button class="btn btn-primary pull-right">Take Images</button>
            </div>

            <div class="form-group">
                <div class="col-md-4 col-xs-4">
                    <label class="control-label">Video:
                        <label class="label label-default">ON</label>
                    </label>
                </div>
                <div class="col-md-4 col-xs-4">
                    <label class="control-label">Pro-Tune:
                        <label class="label label-default">ON</label>
                    </label>
                </div>
                <div class="col-md-4 col-xs-4">
                    <label class="control-label">Format:
                        <label class="label label-default">NTSC</label>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-xs-6">
                    <label class="control-label">Resolution</label>
                    <select v-model="resolution" class="form-control">
                        <option v-for="n in 3">{{ n }}</option>
                    </select>
                    <label class="control-label">FPS</label>
                    <select v-model="fps" class="form-control">
                        <option v-for="n in 3">{{ n }}</option>
                    </select>
                    <label class="control-label">FOV</label>
                    <select v-model="fov" class="form-control">
                        <option v-for="n in 3">{{ n }}</option>
                    </select>
                    <label class="control-label">Color Temp</label>
                    <select v-model="colorTemp" class="form-control">
                        <option v-for="n in 3">{{ n }}</option>
                    </select>
                    <label class="control-label">Color Profile</label>
                    <select v-model="colorProfile" class="form-control">
                        <option v-for="n in 3">{{ n }}</option>
                    </select>
                </div>

                <div class="col-md-6 col-xs-6">
                    <label class="control-label">Shutter Speed</label>
                    <select v-model="shutter" class="form-control">
                        <option v-for="n in 3">{{ n }}</option>
                    </select>
                    <label class="control-label">ISO</label>
                    <select v-model="iso" class="form-control">
                        <option v-for="n in 3">{{ n }}</option>
                    </select>
                    <label class="control-label">Sharpness</label>
                    <select v-model="sharpness" class="form-control">
                        <option v-for="n in 3">{{ n }}</option>
                    </select>
                    <label class="control-label">Exposure</label>
                    <select v-model="exposure" class="form-control">
                        <option v-for="n in 3">{{ n }}</option>
                    </select>
                    <label class="control-label">Orientation</label><br />
                    <button class="btn btn-default">Flip</button>
                </div>
                <button class="btn btn-danger format-button">FORMAT</button>
            </div>
        </jism-layout-primary>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                resolution: [],
                fps: [],
                fov: [],
                colorTemp: [],
                colorProfile: [],
                shutter: [],
                iso: [],
                sharpness: [],
                exposure: [],
            }
        },
        methods: {
            sleep : function() {
                axios.post('/api/group/1/sleep').then((response) => {
                        console.log(response.data);
                    }, (error) => {
                        console.log(error.response.data);
                    });
            },
            wake : function() {
                axios.post('/api/group/1/wake').then((response) => {
                        console.log(response.data);
                    }, (error) => {
                        console.log(error.response.data);
                    });
            },
            getSettings : function() {
                //
            },
            saveSettings : function() {
                //
            }
        },
        created() {
            this.getSettings();
        }
    }
</script>

<style lang="sass" scoped>

</style>
