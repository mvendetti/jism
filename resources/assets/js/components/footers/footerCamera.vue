<template>
    <div>
        <jism-button-stop></jism-button-stop>
        <jism-button-record></jism-button-record>
        <router-link :to="'#'"><i class="fa fa-volume-up" aria-hidden="true"></i></router-link>
        <router-link :to="'#'"><i class="fa fa-plus" aria-hidden="true"></i></i></router-link>
        <router-link :to="'#'"><i class="fa fa-minus" aria-hidden="true"></i></i></router-link>
        <router-link :to="{ name: 'cam-settings' }"><i class="fa fa-cog" aria-hidden="true"></i></router-link>
    </div>
</template>

<script>
    export default {
        //
    }
</script>

<style lang="sass" scoped>

</style>
