<template>
    <div>
        <header>
            <div class="row top-status-bar">
                <jism-header-status></jism-header-status>
                <jism-header-battery></jism-header-battery>
                <jism-header-timer></jism-header-timer>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb pod-ordered-list">
                        <li class="list-item">
                            <router-link :to="{ name: 'home' }">All</router-link>
                        </li>

                        <li v-if="!podRoute && !camRoute" v-for="pod in pods" class="list-item">
                            <router-link :to="{ name: 'pod', params: { pod_id: pod.number } }">P{{ pod.number }}</router-link>
                        </li>

                        <li v-if="podRoute || camRoute" class="list-item">
                            <router-link :to="{ name: 'pod' }">P{{ this.podId }}</router-link>
                        </li>

                        <li v-if="podRoute || camRoute" class="list-item">
                            <router-link v-if="this.camId !== 'left'" :to="{ name: 'camera', params: { pod_id: this.podId, camera_id: 'left' } }">Left</router-link>
                            <span v-if="this.camId === 'left'">Left</span>
                        </li>

                        <li v-if="podRoute || camRoute" class="list-item">
                            <router-link v-if="this.camId !== 'right'" :to="{ name: 'camera', params: { pod_id: this.podId, camera_id: 'right' } }">Right</router-link>
                            <span v-if="this.camId === 'right'">Right</span>
                        </li>
                    </ol>
                </div>
            </div>
        </header>
    </div>
</template>

<script>
    export default {
        computed: {
            pods() {
                return _.orderBy(this.$root.shared.pods, 'number', ['asc']);
            },
            podId() {
                return this.$route.params.pod_id;
            },
            camId() {
                return this.$route.params.camera_id;
            },
            podRoute() {
                return this.$route.name === 'pod';
            },
            camRoute() {
                return this.$route.name === 'camera';
            }
        }
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
