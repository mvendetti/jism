<template>
    <div>
        <jism-layout-primary>
            <h1>Pod Settings</h1>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <button @click.prevent="sleep" class="btn btn-default">Sleep</button>
                    <button @click.prevent="wake" class="btn btn-default">Wake</button>
                </div>
            </div>
        </jism-layout-primary>
    </div>
</template>

<script>
    export default {
        methods: {
            sleep : function() {
                axios.post('/api/pod/' + this.podId + '/sleep').then((response) => {
                    console.log(response.data);
                }, (error) => {
                    console.log(error.response.data);
                });
            },
            wake : function() {
                axios.post('/api/pod/' + this.podId + '/wake').then((response) => {
                    console.log(response.data);
                }, (error) => {
                    console.log(error.response.data);
                });
            },
        }
    }
</script>

<style lang="sass" scoped>

</style>
