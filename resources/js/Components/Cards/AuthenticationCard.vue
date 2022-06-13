<template>
    <div class="authentication-card">
        <div class="form-container">
            <slot></slot>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    hasFooter: {
        type: Boolean,
        default: false,
    },
});
</script>
