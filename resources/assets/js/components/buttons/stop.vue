<template>
    <i @click="stop" class="fa fa-stop" aria-hidden="true"></i>
</template>

<script>
    export default {
        methods: {
            stop() {
                this.$store.dispatch('group/STOP')
                    .then(function() {});
            }
        }
    }
</script>
