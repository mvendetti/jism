<template>
    <div>
        <jism-layout-primary>
            <h1>Remove Pod</h1>
            <ul class="list-group">
                <li v-for="pod in pods" class="list-group-item">
                    P{{ pod.pod_id }}
                    <button class="btn btn-xs btn-danger pull-right">DELETE</button>
                </li>
                <li v-if="!pods.length" class="list-group-item">No pods to remove</li>
            </ul>
        </jism-layout-primary>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                pods: [],
                podId: 0
            }
        },
        methods: {
            removePod : function() {
                axios.delete('/api/pod/' + this.podId).then((response) => {
                        console.log(response.data);
                    }, (error) => {
                        console.log(error.response.data);
                    });
            }
        }
    }
</script>

<style lang="sass" scoped>

</style>
