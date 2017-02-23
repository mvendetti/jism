<template>
    <div>
        <jism-layout-primary>
            <h1>Camera Settings</h1>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <router-link :to="{ name: 'review' }"><button class="btn btn-primary">Review</button></router-link>
                    <button class="btn btn-default">Flip</button>
                    <button @click.prevent="sleep" class="btn btn-default">Sleep</button>
                    <button @click.prevent="wake" class="btn btn-default">Wake</button>
                </div>
            </div>
        </jism-layout-primary>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                camId: 0
            }
        },
        methods: {
            sleep : function() {
                axios.post('/api/camera/' + this.camId + '/sleep').then((response) => {
                        console.log(response.data);
                    }, (error) => {
                        console.log(error.response.data);
                    });
            },
            wake : function() {
                axios.post('/api/camera/' + this.camId + '/wake').then((response) => {
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
