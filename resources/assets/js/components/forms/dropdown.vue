<template>
    <div class="form-group" :class="{'has-error': hasError}">
        <label>{{ label }}</label>
        <select
            class="form-control"
            :placeholder="placeholder"
            v-on:input="$emit('input', $event.target.value)"
        >
            <option v-for="option in options">{{ option }}</option>
        </select>
        <span class="help-block" v-show="hasError">
            {{ errorMsg }}
        </span>
    </div>
</template>

<script>
    export default {
        props: ['value', 'options', 'hasError', 'errorMsg', 'label', 'placeholder'],
    }
</script>
