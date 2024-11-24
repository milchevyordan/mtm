<script setup lang="ts">
withDefaults(
    defineProps<{
        classes?: string;
    }>(),
    {
        classes: "w-2.5 h-2.5 text-blue-100 dark:text-blue-300",
    }
);
</script>

<template>
    <svg
        :class="classes"
        aria-hidden="true"
        fill="none"
        viewBox="0 0 16 12"
    >
        <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M1 5.917 5.724 10.5 15 1.5"
        />
    </svg>
</template>
