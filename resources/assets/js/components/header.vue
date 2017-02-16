<template>
    <div>
        <header>
            <div class="container">
                <div class="row top-status-bar">
                    <div class="col-md-4">
                        <i class="fa fa-circle"></i>
                    </div>
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb pod-ordered-list">
                        <li class="list-item">
                            <router-link :to="{ name: 'home' }">All</router-link>
                        </li>

                        <li v-if="$route.name !== 'pod' && $route.name !== 'camera'" v-for="pod in pods" class="list-item">
                            <router-link :to="{ name: 'pod', params: { pod_id: pod.id } }">{{ pod.name }}</router-link>
                        </li>

                        <li v-if="$route.name === 'pod' || $route.name === 'camera'" class="list-item">
                            <router-link :to="{ name: 'pod' }">P{{ this.podId }}</router-link>
                        </li>

                        <li v-if="$route.name === 'pod' || $route.name === 'camera'" class="list-item">
                            <router-link v-if="this.camId !== 'left'" :to="{ name: 'camera', params: { pod_id: this.podId, cam_id: 'left' } }">Left</router-link>
                            <span v-if="this.camId === 'left'">Left</span>
                        </li>

                        <li v-if="$route.name === 'pod' || $route.name === 'camera'" class="list-item">
                            <router-link v-if="this.camId !== 'right'" :to="{ name: 'camera', params: { pod_id: this.podId, cam_id: 'right' } }">Right</router-link>
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
            podId : function() {
                return this.$route.params.pod_id;
            },
            camId : function() {
                return this.$route.params.cam_id;
            }
        },
        data() {
            return {
                pods: [
                    { name: 'P1', id: 1,
                        cameras: [
                            { name: 'Left', id: 55 },
                            { name: 'Right', id: 56 }
                        ]
                    },
                    { name: 'P2', id: 2 },
                    { name: 'P3', id: 3 }
                ]
            }
        }
    }
</script>

<style lang="sass" scoped>
    .top-status-bar
        padding: 0.25em
    i
        font-size: 2em
        &.fa-circle
            color: green
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
</style>
