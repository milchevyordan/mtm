<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import {computed, ref} from "vue";

const props = defineProps<{
    href: string;
    active?: boolean;
}>();

const showTooltip = ref(false);

const classes = computed(() =>
    props.active
        ? 'border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
        : 'border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out',
);
</script>

<template>
    <div
        class="inline-flex items-center px-1 pt-1 border-b-2"
        :class="classes"
        @mouseenter="showTooltip = true"
        @mouseleave="showTooltip = false"
    >
        <Link
            :href="href"
        >
            <slot />
        </Link>

        <Transition
            enter-active-class="transition ease-out duration-100"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >
            <div
                v-show="showTooltip"
                class="w-[100px] whitespace-nowrap absolute -ml-6 mt-40 z-[1000] overflow-x-hidden bg-white rounded shadow-xl border border-gray-200"
            >
                <slot name="content" />
            </div>
        </Transition>
    </div>
</template>
