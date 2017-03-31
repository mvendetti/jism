<template>
    <div>
        <jism-layout-primary>
            <h1>Disable Pods</h1>
            <ul class="list-group">
                <li v-for="pod in pods" :class="['list-group-item', pod.disabled ? 'disabled' : '']">
                    <label :for="'pod' + pod.number">P{{ pod.number }}</label>
                    <input @click="pod.disabled = !pod.disabled" :value="'pod' + pod.number" type="checkbox" class="pull-right">
                </li>
                <li v-if="!pods.length" class="list-group-item">No pods to disable</li>
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
            //
        },
        created() {
            //
        }
    }
</script>
