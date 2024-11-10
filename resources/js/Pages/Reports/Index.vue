<script setup lang="ts">
import {Head, Link, useForm} from "@inertiajs/vue3";
import {ref} from "vue";

import ResetSaveButtons from "@/Components/HTML/ResetSaveButtons.vue";
import Modal from "@/Components/Modal.vue";
import Table from "@/DataTable/Table.vue";
import {DataTable} from "@/DataTable/types";
import DocumentText from "@/Icons/DocumentText.vue";
import IconTrash from "@/Icons/Trash.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {DeleteForm, Report} from "@/types";
import {dateTimeToLocaleString, dateToLocaleString} from "@/utils";

defineProps<{
    dataTable: DataTable<Report>;
}>();

const showDeleteModal = ref<boolean>(false);

const deleteForm = useForm<DeleteForm>({
    id: null!,
    name: null!,
    created_at: null!,
});

const openDeleteModal = (item: Report) => {
    deleteForm.id = item.id;
    deleteForm.created_at = item.created_at as Date;

    showDeleteModal.value = true;
};

const closeDeleteModal = () => {
    showDeleteModal.value = false;
    deleteForm.reset();
};

const handleDelete = () => {
    deleteForm.delete(route("reports.destroy", deleteForm.id as number), {
        preserveScroll: true,
    });
    closeDeleteModal();
};
</script>

<template>
    <Head :title="'Report'" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Report
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
                            :show-trashed="true"
                            :advanced-filters="false"
                        >
                            <template #additionalContent>
                                <div class="w-full flex gap-2">
                                    <Link
                                        class="w-full md:w-auto border border-gray-300 dark:border-gray-700 rounded-md px-5 py-1.5 active:scale-95 transition hover:bg-gray-50 dark:hover:bg-gray-800"
                                        :href="route('reports.create')"
                                    >
                                        Create Report
                                    </Link>
                                </div>
                            </template>

                            <template #cell(created_at)="{ value, item }">
                                <div class="flex gap-1.5">
                                    {{ dateTimeToLocaleString(value) }}
                                </div>
                            </template>

                            <template #cell(date_from)="{ value, item }">
                                <div class="flex gap-1.5">
                                    {{ dateToLocaleString(value) }}
                                </div>
                            </template>

                            <template #cell(date_to)="{ value, item }">
                                <div class="flex gap-1.5">
                                    {{ dateToLocaleString(value) }}
                                </div>
                            </template>

                            <template #cell(action)="{ value, item }">
                                <div class="flex gap-1.5">
                                    <Link
                                        class="border border-gray-300 dark:border-gray-700 rounded-md p-1 active:scale-90 transition"
                                        :title="'Show report'"
                                        :href="route('reports.show', item.id)"
                                    >
                                        <DocumentText
                                            classes="w-4 h-4 text-[#909090]"
                                        />
                                    </Link>

                                    <button
                                        :title="'Delete'"
                                        class="border border-gray-300 dark:border-gray-700 rounded-md p-1 active:scale-90 transition"
                                        @click="openDeleteModal(item)"
                                    >
                                        <IconTrash classes="w-4 h-4 text-[#909090]" />
                                    </button>
                                </div>
                            </template>
                        </Table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <Modal
        :show="showDeleteModal"
        @close="closeDeleteModal"
    >
        <div
            class="border-b border-gray-100 dark:border-gray-700 px-3.5 p-3 text-xl font-medium"
        >
            Delete report #{{ deleteForm?.id ?? '' }} added on {{ dateTimeToLocaleString(deleteForm?.created_at) }} ?
        </div>

        <form
            class="col-span-2 flex justify-end gap-3 mt-2 pt-1 px-4"
            @submit.prevent="handleDelete"
        >
            <ResetSaveButtons
                :processing="deleteForm.processing"
                :recently-successful="deleteForm.recentlySuccessful"
                :is-delete="true"
                @reset="deleteForm.reset()"
            />
        </form>
    </Modal>

    <Modal
        :show="showDeleteModal"
        @close="closeDeleteModal"
    >
        <div
            class="border-b border-gray-100 dark:border-gray-700 px-3.5 p-3 text-xl font-medium"
        >
            Delete report #{{ deleteForm?.id ?? '' }} added on {{ dateTimeToLocaleString(deleteForm?.created_at) }} ?
        </div>

        <form
            class="col-span-2 flex justify-end gap-3 mt-2 pt-1 px-4"
            @submit.prevent="handleDelete"
        >
            <ResetSaveButtons
                :processing="deleteForm.processing"
                :recently-successful="deleteForm.recentlySuccessful"
                :is-delete="true"
                @reset="deleteForm.reset()"
            />
        </form>
    </Modal>
</template>
