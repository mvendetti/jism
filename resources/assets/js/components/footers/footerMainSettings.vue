<template>
    <div>
        <router-link :to="'#'"><i class="fa fa-stop" aria-hidden="true"></i></router-link>
        <router-link :to="'#'"><i class="fa fa-circle" aria-hidden="true"></i></router-link>
        <router-link :to="{ name: 'assign' }"><i class="fa fa-camera" aria-hidden="true"></i></router-link>
        <router-link :to="{ name: 'home' }"><i class="fa fa-arrow-left" aria-hidden="true"></i></router-link>
    </div>
</template>

<script>
    export default {
        //
    }
</script>

<style lang="sass">

</style>
