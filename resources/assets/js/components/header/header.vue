<template>
    <div>
        <header>
            <div class="row top-status-bar">
                <jism-header-status></jism-header-status>
                <jism-header-battery></jism-header-battery>
                <jism-header-timer></jism-header-timer>
            </div>

            <jism-breadcrumb></jism-breadcrumb>
        </header>
    </div>
</template>

<script>
    export default {
        //
    };
</script>

<style lang="sass">
    .top-status-bar
        padding: 0.25em
        text-align: center
        i
            margin-right: 75px
            &.green
                color: #6AA84F
            &.red
                color: #CC0000
            &.yellow
                color: #FFD966
            &.gray
                color: #CCCCCC
        button
            border: none
            background-color: transparent
    .pod-ordered-list
        border-radius: 0
        border-top: 1px solid #222
        border-bottom: 1px solid #222
        background-color: #e2e2e2
        padding: 0.75em
        li
            &::before
                padding: 0 15px
            a
                &.active
                    color: #777
                &:hover, &:focus
                    text-decoration: none
        .list-item
            font-weight: 900
            font-size: 1.1em
    .dropdown-menu
        &.duration
            left: auto
            right: 0
            float: right
</style>
