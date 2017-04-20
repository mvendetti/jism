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
        </jism-layout-primary>
    </div>
</template>

<script>
    export default {
        computed: {
            podId() {
                return this.$route.params.pod_id;
            }
        },
        methods: {
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
