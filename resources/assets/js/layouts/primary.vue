<template>
    <div>
        <jism-header></jism-header>
        <div class="container wrapper">
            <slot></slot>
        </div>
        <jism-footer></jism-footer>
    </div>
</template>

<script>
    export default {
        created() {
            axios.get('/api/group/1/status').then((response) => {
                this.$root.shared.cameras = response.data;
            }, (error) => {
                console.log(error.response.data);
            });
        }
    }
</script>

<style lang="sass">
    .wrapper
        overflow: scroll
</style>
