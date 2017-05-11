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
    import { mapGetters } from 'vuex'
    export default {
        computed: mapGetters('landlord', ['pods']),
        methods: {
            disable(id, state) {
                var that = this,
                    data = { 'disabled': state, id };

                this.$store.dispatch('pod/UPDATE', data)
                    .then(function() {
                        if(form.successful) {
                            that.$router.push({ name: 'disable' });
                        }
                    });
            }
        }
    }
</script>
