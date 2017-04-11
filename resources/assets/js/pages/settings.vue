<template>
    <div>
        <jism-layout-primary>
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
            <div class="form-group">
                <div class="row">
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
            </div>
            <hr />
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <label class="control-label">Resolution</label>
                        <select v-model="resolution" class="form-control">
                            <option value="1" selected>4K</option>
                            <option value="4">2.7K</option>
                        </select>
                        <label class="control-label">FPS</label>
                        <select v-model="fps" class="form-control">
                            <option value="0">240</option>
                            <option value="1">120</option>
                            <option value="5">60</option>
                            <option value="8" selected>30</option>
                            <option value="10">24</option>
                        </select>
                        <label class="control-label">FOV</label>
                        <select v-model="fov" class="form-control">
                            <option value="0" selected>Wide</option>
                            <option value="1">Medium</option>
                            <option value="2">Narrow</option>
                            <option value="4">Linear</option>
                        </select>
                        <label class="control-label">Color Temp</label>
                        <select v-model="colorTemp" class="form-control">
                            <option value="0">Auto</option>
                            <option value="1">3000K</option>
                            <option value="5">4000K</option>
                            <option value="6">4800K</option>
                            <option value="2" selected>5500K</option>
                            <option value="7">6000K</option>
                            <option value="3">6500K</option>
                            <option value="4">Native</option>

                        </select>
                        <label class="control-label">Color Profile</label>
                        <select v-model="colorProfile" class="form-control">
                            <option value="0">GoPro Color</option>
                            <option value="1" selected>Flat</option>
                        </select>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <label class="control-label">Shutter Speed</label>
                        <select v-model="shutter" class="form-control">
                            <option value="3">1/24</option>
                            <option value="5">1/30</option>
                            <option value="6">1/48</option>
                            <option value="8">1/60</option>
                            <option value="9">1/80</option>
                            <option value="12">1/100</option>
                            <option value="13" selected>1/120</option>
                            <option value="14">1/160</option>
                            <option value="15">1/180</option>
                            <option value="16">1/192</option>
                            <option value="17">1/200</option>
                            <option value="18">1/240</option>
                            <option value="19">1/320</option>
                            <option value="20">1/360</option>
                            <option value="21">1/400</option>
                            <option value="22">1/480</option>
                            <option value="23">1/960</option>
                        </select>
                        <label class="control-label">ISO</label>
                        <select v-model="iso" class="form-control">
                            <option value="0">6400</option>
                            <option value="1">1600</option>
                            <option value="2">400</option>
                            <option value="3">3200</option>
                            <option value="4">800</option>
                            <option value="7">200</option>
                            <option value="8" selected>100</option>
                        </select>
                        <label class="control-label">Sharpness</label>
                        <select v-model="sharpness" class="form-control">
                            <option value="0">High</option>
                            <option value="1" selected>Medium</option>
                            <option value="2">Low</option>
                        </select>
                        <label class="control-label">Exposure</label>
                        <select v-model="exposure" class="form-control">
                            <option value="8">-2.0</option>
                            <option value="7">-1.5</option>
                            <option value="6">-1.0</option>
                            <option value="5">-0.5</option>
                            <option value="4" selected>0.0</option>
                            <option value="3">0.5</option>
                            <option value="2">1.0</option>
                            <option value="1">1.5</option>
                            <option value="0">2.0</option>
                        </select>
                        <label class="control-label">Orientation</label><br />
                        <select v-model="orientation" class="form-control">
                            <option value="1" selected>Up</option>
                            <option value="2">Down</option>
                        </select>
                    </div>
                    <div class="col-md-1 col-xs-1">
                        <button @click="format" class="btn btn-danger format-button">FORMAT</button>
                    </div>
                </div>
            </div>
        </jism-layout-primary>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                resolution: '1', fps: '8', fov: '0',
                colorTemp: '2', colorProfile: '1',
                shutter: '13', iso: '8',
                sharpness: '1', exposure: '4', orientation: '1'
            }
        },
        methods: {
            sleep() {
                axios.post('/api/group/1/sleep').then((response) => {
                        console.log(response.data);
                    }, (error) => {
                        console.log(error.response.data);
                    });
            },
            wake() {
                axios.post('/api/group/1/wake').then((response) => {
                        console.log(response.data);
                    }, (error) => {
                        console.log(error.response.data);
                    });
            },
            saveSettings() {
                var data = {
                    'resolution' : this.resolution,
                    'fps' : this.fps,
                    'fov' : this.fov,
                    'colorTemp' : this.colorTemp,
                    'colorProfile' : this.colorProfile,
                    'shutter' : this.shuttter,
                    'iso' : this.iso,
                    'sharpness' : this.sharpness,
                    'exposure' : this.exposure
                }
                axios.post('/api/group/1/settings', data).then((response) => {
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
