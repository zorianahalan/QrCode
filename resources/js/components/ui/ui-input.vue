<template>
    <input class="input" @input="$emit('update:modelValue', $event.target.value)" />
</template>

<script>
export default {
    name: "ui-input"
}
</script>

<style scoped>
.input:not(.input[type=color]) {
    display: inline-block;
    width: 100%;
    padding: 6px 15px;
    text-align: center;
    font-size: 16px;
    border-radius: 4px;
    border: 2px solid #8770ff;
    transition: .3s all ease;
}

.input:hover, .input:focus {
    outline: none;
    background: #f8f8f8;
    border-color: #7762ff;
}
</style>
