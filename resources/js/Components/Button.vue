<script setup>
defineProps({
    type: {
        type: String,
        default: "submit",
    },
});
</script>

<template>
    <button :type="type" class="stuffed-button">
        <slot />
    </button>
</template>
