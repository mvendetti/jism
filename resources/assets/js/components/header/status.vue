<template>
    <span><i :class="['fa fa-circle', allOnline ? 'green' : 'red']"></i></span>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        computed: mapGetters('landlord', ['allOnline']),
    }
</script>
