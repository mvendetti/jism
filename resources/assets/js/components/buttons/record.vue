<template>
    <i v-on:click="record" class="fa fa-circle" aria-hidden="true"></i>
</template>

<script>
    export default {
        methods: {
            record() {
                this.$store.dispatch('group/RECORD')
                    .then(function() {});
            }
        }
    }
</script>

<style lang="sass" scoped>
    .fa-circle
        color: firebrick
</style>
