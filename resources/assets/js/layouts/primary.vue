<template>
    <div class="container wrapper">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        mounted() {
            var myPods = new Pods(),
                self = this;
            myPods.getAll();
            setTimeout(function() {
                self.$root.shared.pods = myPods.pods;
            }, 500);
        }
    }
</script>

<style lang="sass">
    .wrapper
        overflow: scroll
</style>
