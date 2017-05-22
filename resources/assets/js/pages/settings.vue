<template>
    <div>
        <jism-layout-primary>
            <jism-settings-form
                @submit="save"
                @sleep="sleep"
                @wake="wake"
            >
            </jism-settings-form>
        </jism-layout-primary>
    </div>
</template>

<script>
    export default {
        methods: {
            save(form) {
                var that = this;
                this.$store.dispatch('settings/STORE', form)
                    .then(function() {
                        that.$router.push({ name: 'settings' });
                    });
            },
            sleep(action) {
                this.$store.dispatch('group/SLEEP', action)
                    .then(function() {});
            },
            wake(action) {
                this.$store.dispatch('group/WAKE', action)
                    .then(function() {});
            },
            format() {
                //
            }
        }
    }
</script>
