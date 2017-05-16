<template>
    <div>
        <jism-layout-primary>
            <jism-pod-create-form @submit="submit"></jism-pod-create-form>
        </jism-layout-primary>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        computed: mapGetters('landlord', ['pods']),
        methods: {
            submit(form) {
                var that = this;

                this.$store.dispatch('pod/STORE', form)
                    .then(function() {
                        if(form.successful) {
                            that.$router.push({ name: 'add' });
                        }
                    });
            }
        }
    }
</script>
