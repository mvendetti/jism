<template>
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

                <li v-if="this.$route.name !== 'add' && this.$route.name !== 'pod' && this.$route.name !== 'camera'" class="list-item">
                    <router-link :to="{ name: 'add' }">+</router-link>
                </li>
            </ol>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        computed: {
            ...mapGetters('landlord', ['pods']),
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
    }
</script>
