<template>
    <div>
        <jism-layout-primary>
            <h1>Disable Pods</h1>
            <ul class="list-group">
                <li v-for="pod in pods" :class="['list-group-item', pod.disabled ? 'disabled' : '']">
                    <span>P{{ pod.number }}</span>
                    <input @click="pod.disabled = !pod.disabled" @change="disable(pod.id, pod.disabled)" :value="'pod' + pod.number" type="checkbox" :checked="pod.disabled" class="pull-right">
                </li>
                <li v-if="!pods.length" class="list-group-item">No pods to disable</li>
            </ul>
        </jism-layout-primary>
    </div>
</template>

<script>
    export default {
        computed: {
            pods() {
                return _.orderBy(this.$root.shared.pods, 'number', ['asc']);
            },
        },
        methods: {
            disable(id, state) {
                var data = {
                    'disabled': state
                };
                axios.patch('/api/pod/' + id, data).then((response) => {
                    console.log(response.data);
                }, (error) => {
                    console.log(error.response.data);
                });
            }
        }
    }
</script>
