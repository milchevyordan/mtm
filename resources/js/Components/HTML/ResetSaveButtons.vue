<script setup lang="ts">
import Reset from "@/Icons/Reset.vue";

defineProps<{
    processing: boolean;
    recentlySuccessful: boolean;
}>();
</script>

<template>
    <div
        class="w-40 rounded-lg shadow-lg bg-white dark:bg-gray-800 bottom-20 md:bottom-2.5 right-2 sm:right-5 md:right-4 p-2 element-center gap-2 text-white"
    >
        <button
            :disabled="processing"
            :class="{
                'bg-[#E50000] hover:bg-red-500 dark:bg-red-700 dark:hover:bg-red-600': !processing,
                'bg-gray-400 cursor-not-allowed': processing,
                'rounded p-2 active:scale-95 transition': true,
            }"
            @click="$emit('reset')"
        >
            <Reset />
        </button>

        <button
            :disabled="processing"
            :class="{
                'bg-[#00A793] hover:bg-emerald-500 dark:bg-emerald-700 dark:hover:bg-emerald-600': !processing,
                'bg-gray-400 cursor-not-allowed': processing,
                'rounded px-5 py-2 font-light active:scale-95 transition': true,
            }"
            type="submit"
        >
            Save
        </button>

        <Transition
            enter-active-class="transition ease-in-out"
            enter-from-class="opacity-0"
            leave-active-class="transition ease-in-out"
            leave-to-class="opacity-0"
        >
            <p
                v-if="recentlySuccessful"
                class="text-sm text-gray-600 dark:text-gray-400"
            >
                Saved.
            </p>
        </Transition>
    </div>
</template>
