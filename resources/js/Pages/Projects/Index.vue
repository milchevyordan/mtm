<script setup lang="ts">
import {Head, Link, router} from "@inertiajs/vue3";
import {ref} from "vue";

import Modal from "@/Components/Modal.vue";
import Table from "@/DataTable/Table.vue";
import {DataTable} from "@/DataTable/types";
import {Warehouse} from "@/Enums/Warehouse";
import IconDocument from "@/Icons/Document.vue";
import IconPencilSquare from "@/Icons/PencilSquare.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ProductProject, Project} from "@/types";
import {dateTimeToLocaleString, findEnumKeyByValue} from "@/utils";


defineProps<{
    dataTable: DataTable<Project>;
    showProductsDataTable?: DataTable<ProductProject>;
}>();

const showProductsDataTableModal = ref(false);

const closeProductsDataTableModal = () => {
    showProductsDataTableModal.value = false;
};

const openShowProductsDataTableModal = async (id: number) => {
    window.history.replaceState({}, document.title, window.location.pathname);

    await new Promise((resolve, reject) => {
        router.reload({
            data: { project_id: id },
            only: ["showProductsDataTable"],
            onSuccess: resolve,
            onError: reject,
        });
    });

    showProductsDataTableModal.value = true;
};

</script>

<template>
    <Head :title="'Project'" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Project
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
                            :advanced-filters="false"
                        >
                            <template #additionalContent>
                                <div class="w-full flex gap-2">
                                    <Link
                                        class="w-full md:w-auto border border-gray-300 dark:border-gray-700 rounded-md px-5 py-1.5 active:scale-95 transition hover:bg-gray-50 dark:hover:bg-gray-800"
                                        :href="route('projects.create')"
                                    >
                                        Create Project
                                    </Link>
                                </div>
                            </template>

                            <template #cell(warehouse)="{ value, item }">
                                <div class="flex gap-1.5">
                                    {{ findEnumKeyByValue(Warehouse, value) }}
                                </div>
                            </template>

                            <template #cell(created_at)="{ value, item }">
                                <div class="flex gap-1.5">
                                    {{ dateTimeToLocaleString(value) }}
                                </div>
                            </template>

                            <template #cell(action)="{ value, item }">
                                <div class="flex gap-1.5">
                                    <Link
                                        class="border border-[#E9E7E7] rounded-md p-1 active:scale-90 transition"
                                        :title="'Edit product'"
                                        :href="route('projects.edit', item.id)"
                                    >
                                        <IconPencilSquare
                                            classes="w-4 h-4 text-[#909090]"
                                        />
                                    </Link>

                                    <button
                                        class="border border-[#E9E7E7] rounded-md p-1 active:scale-90 transition"
                                        :title="'Edit product'"
                                        @click="openShowProductsDataTableModal(item.id)"
                                    >
                                        <IconDocument classes="w-4 h-4 text-[#909090]" />
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
        :show="showProductsDataTableModal"
        max-width="6xl"
        @close="closeProductsDataTableModal"
    >
        <div
            class="px-3.5 p-3 text-xl font-medium"
        >
            Products
        </div>

        <div
            v-if="showProductsDataTable"
            class="text-gray-900 dark:text-gray-100"
        >
            <Table
                :data-table="showProductsDataTable"
                :per-page-options="[5, 10, 15, 20, 50]"
                :global-search="true"
                :advanced-filters="false"
                prop-name="showProductsDataTable"
            >
                <template #cell(created_at)="{ value, item }">
                    <div class="flex gap-1.5">
                        {{ dateTimeToLocaleString(value) }}
                    </div>
                </template>
            </Table>
        </div>
    </Modal>
</template>
