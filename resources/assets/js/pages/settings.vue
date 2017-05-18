<template>
    <div>
        <jism-layout-primary>
            <jism-settings-form @submit="save"></jism-settings-form>
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
            sleep() {
                axios.post('/api/group/1/sleep').then((response) => {
                        console.log(response.data);
                    }, (error) => {
                        console.log(error.response.data);
                    });
            },
            wake() {
                axios.post('/api/group/1/wake').then((response) => {
                        console.log(response.data);
                    }, (error) => {
                        console.log(error.response.data);
                    });
            },
            format() {
                //
            }
        }
    }
</script>
