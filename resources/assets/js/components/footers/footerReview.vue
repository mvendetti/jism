<template>
    <div>
        <jism-button-stop></jism-button-stop>
        <jism-button-record></jism-button-record>
        <jism-button-backward></jism-button-backward>
        <jism-button-pause></jism-button-pause>
        <jism-button-forward></jism-button-forward>
        <router-link :to="{ name: 'cam-settings' }"><i class="fa fa-arrow-left" aria-hidden="true"></i></router-link>
    </div>
</template>

<script>
    export default {
        //
    }
</script>

<style lang="sass">

</style>
