<template>
    <button class="btn" :class="$attrs.class">ボタン</button>
</template>

<script setup>
    const btnColorObj = {
        'btn-primary': true,
        'btn-success': false,
        'btn-danger': false,
    }
</script>
