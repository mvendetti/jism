<template>
    <div>
        <jism-layout-primary>
            <h1>Pod Settings</h1>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <button @click="sleep" class="btn btn-default">Sleep</button>
                    <button @click="wake" class="btn btn-default">Wake</button>
                </div>
            </div>

            <h3>Disable Pods</h3>
            <ul class="list-group">
                <li v-for="pod in pods" :class="['list-group-item', pod.disabled ? 'disabled' : '']">
                    <span>P{{ pod.number }}</span>
                    <input @click="pod.disabled = !pod.disabled" @change="disable(pod.id, pod.disabled)" :value="'pod' + pod.number" type="checkbox" :checked="pod.disabled" class="pull-right">
                </li>
                <li v-if="!pods.length" class="list-group-item">No pods to disable</li>
            </ul>
        </jism-layout-primary>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        computed: mapGetters('landlord', ['pods']),
        methods: {
            disable(id, state) {
                var that = this,
                    data = { 'disabled': state, id };

                this.$store.dispatch('pod/UPDATE', data)
                    .then(function() {
                        if(form.successful) {
                            that.$router.push({ name: 'pod-settings' });
                        }
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
