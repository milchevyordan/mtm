<script setup lang="ts">
import { onMounted, ref } from 'vue';

const model = defineModel<string | null>({ required: true });

const textarea = ref<HTMLTextAreaElement | null>(null);

onMounted(() => {
    if (textarea.value?.hasAttribute('autofocus')) {
        textarea.value?.focus();
    }
});

defineExpose({ focus: () => textarea.value?.focus() });
</script>

<template>
    <textarea
        ref="textarea"
        v-model="model"
        class="rounded-md border-gray-300 shadow-sm text-gray-700 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
    />
</template>