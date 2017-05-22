<template>
    <div>
        <jism-layout-primary>
            <h1>Pod {{ pod.number }} Settings</h1>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <button @click="sleep" class="btn btn-default">Sleep</button>
                    <button @click="wake" class="btn btn-default">Wake</button>
                </div>
            </div>

            <h3>Disable</h3>
            <ul class="list-group">
                <li :class="['list-group-item', pod.disabled ? 'disabled' : '']">
                    <span>P{{ pod.number }}</span>
                    <input @click="pod.disabled = !pod.disabled" @change="disable(pod.disabled)" :value="'pod' + pod.number" type="checkbox" :checked="pod.disabled" class="pull-right">
                </li>
            </ul>
        </jism-layout-primary>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        computed: mapGetters('landlord', ['pod']),
        methods: {
            disable(state) {
                var data = { 'disabled': state };

                axios.patch('/api/pod/' + this.pod.number, data).then((response) => {
                   console.log(response.data);
               }, (error) => {
                   console.log(error.response.data);
               });
            },
            sleep() {
                axios.post('/api/pod/' + this.podId + '/sleep').then((response) => {
                    console.log(response.data);
                }, (error) => {
                    console.log(error.response.data);
                });
            },
            wake() {
                axios.post('/api/pod/' + this.podId + '/wake').then((response) => {
                    console.log(response.data);
                }, (error) => {
                    console.log(error.response.data);
                });
            },
        }
    }
</script>
