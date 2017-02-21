<template>
    <div>
        <router-link :to="'#'"><i class="fa fa-backward" aria-hidden="true"></i></router-link>
        <router-link :to="'#'"><i class="fa fa-pause" aria-hidden="true"></i></router-link>
        <router-link :to="'#'"><i class="fa fa-forward" aria-hidden="true"></router-link>
        <router-link :to="{ name: 'camera' }"><i class="fa fa-arrow-left" aria-hidden="true"></i></router-link>
    </div>
</template>

<script>
    export default {
        //
    }
</script>

<style lang="sass">

</style>
