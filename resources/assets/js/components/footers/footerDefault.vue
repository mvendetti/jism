<template>
    <div>
        <jism-button-stop></jism-button-stop>
        <jism-button-record></jism-button-record>
        <router-link v-if="$route.name === 'pod-settings'" :to="{ name: 'pod' }"><i class="fa fa-arrow-left" aria-hidden="true"></i></router-link>
        <router-link v-if="$route.name === 'cam-settings'" :to="{ name: 'camera' }"><i class="fa fa-arrow-left" aria-hidden="true"></i></router-link>
        <router-link v-if="$route.name === 'add'" :to="{ name: 'assign' }"><i class="fa fa-arrow-left" aria-hidden="true"></i></router-link>
        <router-link v-if="$route.name === 'remove'" :to="{ name: 'assign' }"><i class="fa fa-arrow-left" aria-hidden="true"></i></router-link>
        <router-link v-if="$route.name === 'disable'" :to="{ name: 'assign' }"><i class="fa fa-arrow-left" aria-hidden="true"></i></router-link>
    </div>
</template>

<script>
    export default {
        //
    }
</script>

<style lang="sass">

</style>
