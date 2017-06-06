<template>
    <div>
        <jism-layout-primary>
            <h1>Pod {{ pod.number }}</h1>
        </jism-layout-primary>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        computed: mapGetters('landlord', ['pod']),
    }
</script>
