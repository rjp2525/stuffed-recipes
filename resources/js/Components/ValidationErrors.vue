<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

const errors = computed(() => usePage().props.value.errors);

const hasErrors = computed(() => Object.keys(errors.value).length > 0);
</script>

<template>
    <div
        v-if="hasErrors"
        class="border-l-4 border-l-red-600 bg-red-100/20 p-4 mb-4 font-medium text-sm text-red-600"
    >
        <div class="font-medium text-red-600">
            Whoops! There was something wrong with your request.
        </div>

        <ul class="mt-3 ml-3 list-disc list-inside text-sm text-red-600">
            <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
        </ul>
    </div>
</template>
