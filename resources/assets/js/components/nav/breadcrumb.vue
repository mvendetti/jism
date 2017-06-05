<template>
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb pod-ordered-list">
                <li class="list-item">
                    <router-link :to="{ name: 'home' }">
                        All
                    </router-link>
                </li>

                <li
                    v-if="!pod_route && !camera_route"
                    v-for="pod in pods"
                    class="list-item"
                >
                    <router-link
                        :to="{ name: 'pod', params: { pod_id: pod.id, pod_number: pod.number } }"
                    >
                        P{{ pod.number }}
                    </router-link>
                </li>

                <li v-if="pod_route || camera_route" class="list-item">
                    <router-link :to="{ name: 'pod', params: { pod_number: pod.number} }">
                        P{{ pod.number }}
                    </router-link>
                </li>

                <li v-if="pod_route || camera_route" class="list-item">
                    <router-link
                        v-if="camera_id !== 'left'"
                        :to="{ name: 'camera', params: { pod_id: pod_id, pod_number: pod.number, camera_id: 'left' } }"
                    >
                        Left
                    </router-link>
                    <span v-if="camera_id === 'left'">Left</span>
                </li>

                <li v-if="pod_route || camera_route" class="list-item">
                    <router-link
                        v-if="camera_id !== 'right'"
                        :to="{ name: 'camera', params: { pod_id: pod_id, pod_number: pod.number, camera_id: 'right' } }"
                    >
                        Right
                    </router-link>
                    <span v-if="camera_id === 'right'">Right</span>
                </li>

                <li v-if="$route.name === 'home' && pods.length <= 2" class="list-item">
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
            ...mapGetters('landlord', ['pod', 'pods']),
            pod_id() {
                return this.$route.params.pod_id;
            },
            camera_id() {
                return this.$route.params.camera_id;
            },
            pod_route() {
                return this.$route.name === 'pod';
            },
            camera_route() {
                return this.$route.name === 'camera';
            }
        }
    }
</script>
