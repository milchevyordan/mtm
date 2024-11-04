<script setup lang="ts">
import {Head, useForm} from "@inertiajs/vue3";

import Table from "@/DataTable/Table.vue";
import {DataTable} from "@/DataTable/types";
import Check from "@/Icons/Check.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {User} from "@/types";
import {dateTimeToLocaleString} from "@/utils";

interface Notification {
    readonly id: number;
    creator: User;
    data: {
        user_name: string;
        model_name: string;
        model_id: number;
    };
}

defineProps<{
    dataTable: DataTable<Notification>;
    unreadNotificationIds: Array<number>;
}>();

const updateForm = useForm<{
    id: number;
}>({
    id: null!,
});

const markRead = (itemId: number) => {
    updateForm.id = itemId;

    updateForm.put(route("notifications.read", updateForm.id as number), {
        preserveScroll: true,
        onSuccess: () => {
            updateForm.reset();
        },
        onError: () => {
        },
    });
};
</script>

<template>
    <Head :title="'Notifications'"/>

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Notifications
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <Table
                            :data-table="dataTable"
                            :per-page-options="[5, 10, 15, 20, 50]"
                            :global-search="true"
                            :selected-row-indexes="unreadNotificationIds"
                            :selected-row-column="'id'"
                        >
                            <template #cell(data)="{ value, item }">
                                <div class="flex gap-1.5">
                                    {{ value.message }}
                                </div>
                            </template>

                            <template #cell(created_at)="{ value, item }">
                                <div class="flex gap-1.5">
                                    {{ dateTimeToLocaleString(value) }}
                                </div>
                            </template>

                            <template #cell(read_at)="{ value, item }">
                                <div class="flex gap-1.5">
                                    <button
                                        v-if="!item.read_at"
                                        :title="'Mark read'"
                                        :disabled="updateForm.processing"
                                        class="border border-[#E9E7E7] rounded-md p-1 active:scale-90 transition"
                                        @click="markRead(item.id)"
                                    >
                                        <Check classes="w-4 h-4 text-slate-300" />
                                    </button>
                                    <div v-else>
                                        {{ dateTimeToLocaleString(value) }}
                                    </div>
                                </div>
                            </template>
                        </Table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
