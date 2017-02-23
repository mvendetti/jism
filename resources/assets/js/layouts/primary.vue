<template>
    <div>
        <jism-header></jism-header>
        <div class="wrapper">
            <slot></slot>
        </div>
        <jism-footer></jism-footer>
    </div>
</template>

<script>
    export default {

    }
</script>

<style lang="sass">
    .wrapper
        overflow: scroll
</style>
