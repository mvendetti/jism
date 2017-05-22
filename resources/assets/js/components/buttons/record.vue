<template>
    <i v-on:click="record" class="fa fa-circle" aria-hidden="true"></i>
</template>

<script>
    export default {
        data() {
            return {
                action: new JismForm({
                    record: 'record',
                })
            }
        },
        methods: {
            record() {
                this.$store.dispatch('group/RECORD', this.action)
                    .then(function() {});
            }
        }
    }
</script>

<style lang="sass" scoped>
    .fa-circle
        color: firebrick
</style>
