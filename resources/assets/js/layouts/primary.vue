<template>
    <div>
        <jism-header></jism-header>
        <div class="container wrapper">
            <slot></slot>
        </div>
        <jism-footer></jism-footer>
    </div>
</template>

<script>
    export default {
        created() {
            var myCameras = new Cameras(),
                self = this;
            myCameras.getAll();
            setTimeout(function() {
                self.$root.shared.cameras = myCameras.cameras;
            }, 500);
        }
    }
</script>

<style lang="sass">
    .wrapper
        overflow: scroll
</style>
