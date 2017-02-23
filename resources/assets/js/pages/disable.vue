<template>
    <div>
        <jism-layout-primary>
            <h1>Disable Pods</h1>
            <ul class="list-group">
                <li v-for="pod in pods" :class="['list-group-item', this.disabled ? 'disabled' : '']">
                    <label :for="'pod' + pod.pod_id">P{{ pod.pod_id }}</label>
                    <input v-model="selected" :value="'pod' + pod.pod_id" type="checkbox" class="pull-right">
                </li>
                <li v-if="!pods.length" class="list-group-item">No pods to disable</li>
            </ul>
            <button class="btn btn-primary pull-right">Disable</button>
        </jism-layout-primary>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                pods: [],
                disabled: false,
                selected:[],
            }
        },
        methods: {
            getPods : function() {
                axios.get('/api/pod/').then((response) => {
                    this.pods = response.data;
                }, (error) => {
                    console.log(error.response.data);
                });
            },
            disablePods : function() {
                const data = this.selected;
                axios.post('/api/pod/disable', data).then((response) => {
                    this.disabled = true;
                }, (error) => {
                    console.log(error.response.data);
                });
            }
        },
        created() {
            this.getPods();
        }
    }
</script>

<style lang="sass" scoped>

</style>
