<template>
    <div>
        <footer>
            <jism-footer-main v-if="$route.name === 'home'"></jism-footer-main>
            <jism-footer-main-settings v-if="$route.name === 'settings'"></jism-footer-main-settings>
            <jism-footer-assign v-if="$route.name === 'assign'"></jism-footer-assign>
            <jism-footer-pod v-if="$route.name === 'pod'"></jism-footer-pod>
            <jism-footer-camera v-if="$route.name === 'camera'"></jism-footer-camera>
            <jism-footer-review v-if="$route.name === 'review'"></jism-footer-review>
            <jism-footer-default v-if="$route.name === 'pod-settings'"></jism-footer-default>
            <jism-footer-default v-if="$route.name === 'cam-settings'"></jism-footer-default>
            <jism-footer-default v-if="$route.name === 'add'"></jism-footer-default>
            <jism-footer-default v-if="$route.name === 'remove'"></jism-footer-default>
            <jism-footer-default v-if="$route.name === 'disable'"></jism-footer-default>
        </footer>
    </div>
</template>

<script>
    export default {
        //
    }
</script>

<style lang="sass">
    footer
        position: fixed
        bottom: 0
        text-align: center
        width: 100%
        padding: 1em
        background-color: #E2E2E2
        border-top: 1px solid #222
        a
            color: #636B6F
        .fa
            margin: 0 15px
</style>
