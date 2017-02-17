<template>
    <div>
        <router-link :to="'#'"><i class="fa fa-stop" aria-hidden="true"></i></router-link>
        <router-link :to="'#'"><i class="fa fa-circle" aria-hidden="true"></i></router-link>
        <router-link v-if="$route.name === 'pod-settings'" :to="{ name: 'pod' }"><i class="fa fa-arrow-left" aria-hidden="true"></i></router-link>
        <router-link v-if="$route.name === 'cam-settings'" :to="{ name: 'camera' }"><i class="fa fa-arrow-left" aria-hidden="true"></i></router-link>
    </div>
</template>

<script>
    export default {
        //
    }
</script>

<style lang="sass">

</style>
