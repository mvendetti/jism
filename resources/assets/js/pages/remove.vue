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
    import { mapGetters } from 'vuex'
    export default {
        computed: mapGetters('landlord', ['pods']),
        methods: {
            removePod : function(id) {
                var that = this;

                this.$store.dispatch('pod/DESTROY', id)
                    .then(function() {
                        if(form.successful) {
                            that.$router.push({ name: 'remove' });
                        }
                    });
            }
        }
    }
</script>
