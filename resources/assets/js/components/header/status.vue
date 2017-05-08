<template>
    <i :class="['fa fa-circle', this.isOnline ? 'green' : 'yellow']"></i></span>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        data() {
            return {
                isOnline: false,
            }
        }
    }
</script>
