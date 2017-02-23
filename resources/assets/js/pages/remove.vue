<template>
    <div>
        <jism-layout-primary>
            <h1>Remove Pod</h1>
        </jism-layout-primary>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                podId: 0
            }
        },
        methods: {
            removePod : function() {
                axios.delete('/api/pod/' + this.podId).then((response) => {
                        console.log(response.data);
                    }, (error) => {
                        console.log(error.response.data);
                    });
            }
        }
    }
</script>

<style lang="sass" scoped>

</style>
