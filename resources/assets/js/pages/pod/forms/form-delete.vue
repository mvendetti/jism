<template>
    <div>
        <h1>Delete Pod</h1>
        <div class="form-group">
            <jism-form-dropdown
                v-model="form.pod_id"
                v-bind:hasError="form.errors.has('pod_id')"
                v-bind:errorMsg="form.errors.get('pod_id')"
                v-bind:options="values"
            ></jism-form-dropdown>
            <button
                type="submit"
                class="btn btn-danger btn-block"
                :disabled="form.busy"
                @click="destroy"
            >Delete</button>
        </div>
        <div class="panel-body" v-show="form.errors.hasUnreadErrors()">
            <div class="alert alert-danger" role="alert" v-for="error in form.errors.flattenUnread()">{{ error }}</div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    export default {
        computed: {
            ...mapGetters('landlord', ['pods', 'cameras']),
            values() {
                var vals = [];

                _.forEach(this.pods, (value) => {
                    vals.push({ value: value.id, title: value.number });
                });
                return vals;
            }
        },
        data() {
            return {
                form: new JismForm({
                    pod_id: null,
                })
            }
        },
        methods: {
            destroy() {
                this.$emit('delete', this.form);
            }
        }
    }
</script>
