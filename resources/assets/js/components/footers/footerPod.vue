<template>
    <div>
        <jism-button-stop></jism-button-stop>
        <jism-button-record></jism-button-record>
        <jism-button-reference></jism-button-reference>
        <router-link :to="'#'"><i class="fa fa-crosshairs" aria-hidden="true"></i></i></router-link>
        <router-link :to="{ name: 'pod-settings' }"><i class="fa fa-cog" aria-hidden="true"></i></router-link>
    </div>
</template>

<script>
    export default {
        //
    }
</script>

<style lang="sass">

</style>
