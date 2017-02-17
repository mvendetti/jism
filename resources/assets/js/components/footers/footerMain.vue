<template>
    <div>
        <router-link :to="'#'"><i class="fa fa-stop" aria-hidden="true"></i></router-link>
        <router-link :to="'#'"><i class="fa fa-circle" aria-hidden="true"></i></router-link>
        <router-link :to="'#'"><i class="fa fa-xing" aria-hidden="true"></i></router-link>
        <router-link :to="{ name: 'settings' }"><i class="fa fa-cog" aria-hidden="true"></i></router-link>
    </div>
</template>

<script>
    export default {
        //
    }
</script>

<style lang="sass">
    .fa-circle
        color: firebrick
</style>
