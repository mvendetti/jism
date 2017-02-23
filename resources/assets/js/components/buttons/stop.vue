<template>
    <i @click="stopRecording" class="fa fa-stop" aria-hidden="true"></i>
</template>

<script>
    export default {
        methods: {
            stopRecording : function() {
                axios.post('/api/camera/1/stop').then((response) => {
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
