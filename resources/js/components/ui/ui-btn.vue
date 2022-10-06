<template>
    <button class="btn"><slot></slot></button>
</template>

<script>
export default {
    name: "ui-btn"
}
</script>

<style scoped>
    .btn {
        display: inline-block;
        width: 100%;
        padding: 8px 15px;
        border: 0;
        background: #8770ff;
        color: #fff;
        font-size: 16px;
        border-radius: 4px;
        transition: .3s all ease;
    }
    .btn:hover {
        background: #7762ff;
    }
</style>
