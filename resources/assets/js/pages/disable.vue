<template>
    <div>
        <jism-layout-primary>
            <h1>Disable Pods</h1>
            <ul class="list-group">
                <li v-for="pod in pods" :class="['list-group-item', pod.disabled ? 'disabled' : '']">
                    <label :for="'pod' + pod.pod_id">P{{ pod.pod_id }}</label>
                    <input @click="pod.disabled = !pod.disabled" :value="'pod' + pod.pod_id" type="checkbox" class="pull-right">
                </li>
                <li v-if="!pods.length" class="list-group-item">No pods to disable</li>
            </ul>
        </jism-layout-primary>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                pods: [
                    { name: 'P1', pod_id: 1, disabled: false },
                    { name: 'P2', pod_id: 2, disabled: false },
                    { name: 'P3', pod_id: 3, disabled: false }
                ]
            }
        },
        methods: {
            getPods : function() {
                axios.get('/api/pod').then((response) => {
                    this.pods = response.data;
                }, (error) => {
                    console.log(error.response.data);
                });
            }
        },
        created() {
            // this.getPods();
        }
    }
</script>
