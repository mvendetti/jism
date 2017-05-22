<template>
    <i @click="stop" class="fa fa-stop" aria-hidden="true"></i>
</template>

<script>
    export default {
        data() {
            return {
                action: new JismForm({
                    stop: 'stop',
                })
            }
        },
        methods: {
            stop() {
                this.$store.dispatch('group/STOP', this.action)
                    .then(function() {});
            }
        }
    }
</script>
