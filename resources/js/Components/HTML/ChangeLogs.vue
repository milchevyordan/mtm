<script setup lang="ts">

import {router} from "@inertiajs/vue3";
import {ref} from "vue";

import Accordion from "@/Components/HTML/Accordion.vue";
import Modal from "@/Components/Modal.vue";
import Table from "@/DataTable/Table.vue";
import {DataTable} from "@/DataTable/types";
import {ChangeLogsChange, ChangeLog} from "@/types";
import { dateTimeToLocaleString } from "@/utils";

defineProps<{
    changeLogsLimited?: ChangeLog[];
    changeLogs?: DataTable<ChangeLog>;
}>();

const showChangeLogModal = ref<boolean>(false);

const openChangeLogModal = async () => {
    await new Promise((resolve, reject) => {
        router.reload({
            only: ["changeLogs"],
            onSuccess: resolve,
            onError: reject,
        });
    });

    showChangeLogModal.value = true;
};

const closeChangeLogModal = () => {
    showChangeLogModal.value = false;
};
</script>

<template>
    <div
        class="relative rounded-lg shadow-sm bg-white dark:bg-gray-800 py-4 sm:py-6 px-4 mt-4"
    >
        <Accordion>
            <template #head>
                <div class="mb-4 text-gray-900 dark:text-gray-100 flex justify-between">
                    <div class="font-semibold text-xl sm:text-2xl">
                        Change Logs
                    </div>

                    <button
                        class="mr-10 md:w-auto border border-gray-300 dark:border-gray-700 rounded-md px-5 py-1.5 active:scale-95 transition hover:bg-gray-50 dark:hover:bg-gray-800"
                        @click="openChangeLogModal"
                    >
                        Show All
                    </button>
                </div>
            </template>

            <div
                v-if="changeLogsLimited"
                class="overflow-y-auto max-h-96"
            >
                <div
                    v-for="(changeLog, index) in changeLogsLimited"
                    :key="index"
                    :class="[
                        'grid lg:grid-cols-2 gap-4 mb-4 pb-4',
                        {
                            'border-b border-[#E9E7E7] dark:border-gray-700': index !== changeLogsLimited.length - 1,
                        },
                    ]"
                >
                    <div class="lg:border-r border-[#E9E7E7] dark:border-gray-700 lg:pr-8 sm:gap-y-2 items-center flex flex-col">
                        <div class="element-center">
                            <span class="mr-2 text-[#C7C7CC] dark:text-gray-500">
                                Creator
                            </span>
                            <span class="text-[#6D6D73] dark:text-gray-200 bg-[#F2F2F7] dark:bg-gray-700 cursor-default rounded px-3 py-1 font-light m-1">
                                {{ changeLog.creator.name }}
                            </span>
                        </div>
                        <div class="element-center">
                            <span class="mr-2 text-[#C7C7CC] dark:text-gray-500">
                                Date
                            </span>
                            <span class="text-[#6D6D73] dark:text-gray-200 bg-[#F2F2F7] dark:bg-gray-700 cursor-default rounded px-3 py-1 font-light m-1">
                                {{ dateTimeToLocaleString(changeLog.created_at) }}
                            </span>
                        </div>
                    </div>

                    <div class="lg:pl-4 items-center flex flex-row">
                        <ul class="flex flex-wrap">
                            <li
                                v-for="(changeItem, indexChange) in JSON.parse(changeLog.change)"
                                :key="indexChange"
                            >
                                <ul class="flex flex-wrap">
                                    <li
                                        v-for="(item, indexItem) in changeItem as ChangeLogsChange[]"
                                        :key="indexItem"
                                        class="border border-gray-200 dark:border-gray-600 px-3 py-1 rounded-lg space-x-1 m-1 text-gray-900 dark:text-gray-200"
                                        :class="{'bg-red-100 dark:bg-red-800': item?.old && !item?.new}"
                                    >
                                        <span v-if="String(indexChange) != 'main'">{{ indexChange }} |</span>
                                        <span>{{ indexItem }} |</span>
                                        <span
                                            v-if="item?.old"
                                            class="text-gray-500 dark:text-gray-400"
                                        >
                                            {{ item?.old }}
                                        </span>
                                        <span v-if="item?.old && item?.new">&rarr;</span>
                                        <span v-if="item?.new">
                                            {{ item?.new }}
                                        </span>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </Accordion>
    </div>

    <Modal
        :show="showChangeLogModal"
        max-width="6xl"
        @close="closeChangeLogModal"
    >
        <div
            class="px-3.5 p-3 text-xl font-medium"
        >
            Change Logs
        </div>

        <div
            v-if="changeLogs"
            class="text-gray-900 dark:text-gray-100"
        >
            <Table
                :data-table="changeLogs"
                :per-page-options="[5, 10, 15, 20, 50]"
                :global-search="true"
                :advanced-filters="false"
                prop-name="changeLogs"
            >
                <template #cell(change)="{ value, item }">
                    <div class="flex gap-1.5">
                        <ul class="flex flex-wrap">
                            <li
                                v-for="(changeItem, indexChange) in JSON.parse(value)"
                                :key="indexChange"
                            >
                                <ul class="flex flex-wrap">
                                    <li
                                        v-for="(change, indexItem) in changeItem as ChangeLogsChange[]"
                                        :key="indexItem"
                                        class="border border-gray-200 dark:border-gray-600 px-3 py-1 rounded-lg space-x-1 m-1 text-gray-900 dark:text-gray-200"
                                        :class="{'bg-red-100 dark:bg-red-800': change?.old && !change?.new}"
                                    >
                                        <span v-if="String(indexChange) != 'main'">{{ indexChange }} |</span>
                                        <span>{{ indexItem }} |</span>
                                        <span
                                            v-if="change?.old"
                                            class="text-gray-500 dark:text-gray-400"
                                        >
                                            {{ change?.old }}
                                        </span>
                                        <span v-if="change?.old && change?.new">&rarr;</span>
                                        <span v-if="change?.new">
                                            {{ change?.new }}
                                        </span>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </template>

                <template #cell(created_at)="{ value, item }">
                    <div class="flex gap-1.5">
                        {{ dateTimeToLocaleString(value) }}
                    </div>
                </template>
            </Table>
        </div>
    </Modal>
</template>
