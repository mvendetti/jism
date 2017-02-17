<template>
    <div>
        <footer>
            <div class="container">
                <div v-if="$route.name === true">
                    <jism-footer-main></jism-footer-main>
                </div>
                <div v-if="">
                    <jism-footer-main-settings></jism-footer-main-settings>
                </div>
                <div v-if="">
                    <jism-footer-standard></jism-footer-standard>
                </div>
                <div v-if="">
                    <jism-footer-available></jism-footer-available>
                </div>
                <div v-if="">
                    <jism-footer
                </div>
                <div v-if="">

                </div>
            </div>
        </footer>
    </div>
</template>

<script>
    export default {
        //
    }
</script>

<style lang="sass" scoped>
    footer
        position: absolute
        bottom: 0
        width: 480px
        height: 60px
        line-height: 60px
        background-color: #E2E2E2
        border-top: 1px solid #222
</style>
