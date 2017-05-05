<template>
    <i v-on:click="start" class="fa fa-circle" aria-hidden="true"></i>
</template>

<script>
    export default {
        methods: {
            start() {
                this.$emit('record');
            }
        }
    }
</script>

<style lang="sass" scoped>
    .fa-circle
        color: firebrick
</style>
