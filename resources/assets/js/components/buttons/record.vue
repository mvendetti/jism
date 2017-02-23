<template>
    <i @click="startRecording" class="fa fa-circle" aria-hidden="true"></i>
</template>

<script>
    export default {
        methods: {
            startRecording : function() {
                axios.post('/api/camera/1/record').then((response) => {
                    console.log(response.data);
                }, (error) => {
                    console.log(error.response.data);
                });
            }
        }
    }
</script>

<style lang="sass" scoped>
    .fa-circle
        color: firebrick
</style>
