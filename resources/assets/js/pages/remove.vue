<template>
    <div>
        <jism-layout-primary>
            <h1>Remove Pod</h1>
            <ul class="list-group">
                <li v-for="pod in pods" class="list-group-item">
                    P{{ pod.number }}
                    <button @click="removePod(pod.id)" class="btn btn-xs btn-danger pull-right">DELETE</button>
                </li>
                <li v-if="!pods.length" class="list-group-item">No pods to remove</li>
            </ul>
        </jism-layout-primary>
    </div>
</template>

<script>
    export default {
        computed: {
            pods : function() {
                return _.orderBy(this.$root.shared.pods, 'number', ['asc']);
            },
        },
        data() {
            return {
                //
            }
        },
        methods: {
            removePod : function(id) {
                axios.delete('/api/pod/' + id).then((response) => {
                        console.log(response.data);
                    }, (error) => {
                        console.log(error.response.data);
                    });
            }
        }
    }
</script>
