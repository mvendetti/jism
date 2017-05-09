<template>
    <i :class="['fa fa-circle', online ? 'green' : 'yellow']"></i></span>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        computed: mapGetters('landlord', ['online']),
    }
</script>
