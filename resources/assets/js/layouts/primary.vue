<template>
    <div class="container wrapper">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        mounted() {
            var myCameras = new Cameras(),
                self = this;
            myCameras.getAll();
            setTimeout(function() {
                self.$root.shared.cameras = myCameras.cameras;
            }, 500);
            var myPods = new Pods(),
                self = this;
            myPods.getAll();
            setTimeout(function() {
                self.$root.shared.pods = myPods.pods;
            }, 500);

            this.$store.dispatch('status/LOAD');
        }
    }
</script>

<style lang="sass">
    .wrapper
        overflow: scroll
</style>
