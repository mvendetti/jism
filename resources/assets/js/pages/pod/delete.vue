<template>
    <div>
        <jism-layout-primary>
            <jism-pod-delete-form @delete="destroy"></jism-pod-delete-form>
        </jism-layout-primary>
    </div>
</template>

<script>
    export default {
        methods: {
            destroy(form) {
                var that = this;
                this.$store.dispatch('pod/DESTROY', form)
                    .then(function() {
                        that.$router.push({ name: 'remove' });
                    });
            },
        }
    }
</script>
