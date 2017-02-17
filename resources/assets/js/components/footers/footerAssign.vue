<template>
    <div>
        <router-link :to="'#'"><i class="fa fa-plus" aria-hidden="true"></i></router-link>
        <router-link :to="'#'"><i class="fa fa-minus" aria-hidden="true"></i></router-link>
        <router-link :to="'#'"><i class="fa fa-ban" aria-hidden="true"></i></router-link>
        <router-link :to="{ name: 'settings' }"><i class="fa fa-arrow-left" aria-hidden="true"></i></router-link>
    </div>
</template>

<script>
    export default {
        //
    }
</script>

<style lang="sass">

</style>
