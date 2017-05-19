<template>
    <div class="form-group" :class="{'has-error': hasError}">
        <label>{{ label }}</label>
        <select
            class="form-control"
            :placeholder="placeholder"
            v-on:input="$emit('input', $event.target.value)"
        >
            <option v-for="option in options" :selected="selected === option.value" :value="option.value">{{ option.title }}</option>
        </select>
        <span class="help-block" v-show="hasError">
            {{ errorMsg }}
        </span>
    </div>
</template>

<script>
    export default {
        props: ['value', 'options', 'selected', 'hasError', 'errorMsg', 'label', 'placeholder'],
    }
</script>
