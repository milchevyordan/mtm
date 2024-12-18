<script setup lang="ts">
import {Head, Link} from "@inertiajs/vue3";

import Accordion from "@/Components/HTML/Accordion.vue";
import ChangeLogs from "@/Components/HTML/ChangeLogs.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Select from "@/Components/Select.vue";
import TextInput from "@/Components/TextInput.vue";
import Table from "@/DataTable/Table.vue";
import {DataTable} from "@/DataTable/types";
import {ProductType} from "@/Enums/ProductType";
import {Warehouse} from "@/Enums/Warehouse";
import DocumentText from "@/Icons/DocumentText.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ChangeLog, ProductProject, Project} from "@/types";
import {dateTimeToLocaleString, findEnumKeyByValue, replaceEnumUnderscores} from "@/utils";

defineProps<{
    project: Project;
    dataTable: DataTable<ProductProject>
    changeLogs?: DataTable<ChangeLog>;
}>();
</script>

<template>
    <Head :title="'Проект'" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Проект
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
                <div
                    class="bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="grid lg:grid-cols-1 xl:grid-cols-2 gap-4">
                            <div class="mt-6 space-y-6">
                                <div>
                                    <InputLabel
                                        for="name"
                                        value="Име"
                                    />

                                    <TextInput
                                        id="name"
                                        :model-value="project.name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        disabled
                                    />
                                </div>

                                <div>
                                    <InputLabel
                                        for="warehouse"
                                        value="Склад"
                                    />

                                    <Select
                                        :selected-option-value="project.warehouse"
                                        :name="'warehouse'"
                                        :options="Warehouse"
                                        :placeholder="'Склад'"
                                        disabled
                                        class="mt-1 block w-full mb-3.5"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="relative rounded-lg shadow-sm bg-white dark:bg-gray-800 py-4 sm:py-6 px-4 mt-4"
                >
                    <Accordion>
                        <template #head>
                            <div class="font-semibold text-xl sm:text-2xl mb-4 text-gray-900 dark:text-gray-100">
                                Продукти
                            </div>
                        </template>

                        <div class="text-gray-900 dark:text-gray-100">
                            <Table
                                :data-table="dataTable"
                                :per-page-options="[5, 10, 15, 20, 50]"
                                :global-search="true"
                                :type-search="true"
                                :advanced-filters="false"
                            >
                                <template #cell(created_at)="{ value, item }">
                                    <div class="flex gap-1.5">
                                        {{ dateTimeToLocaleString(value) }}
                                    </div>
                                </template>

                                <template #cell(product.type)="{ value, item }">
                                    <div class="flex gap-1.5">
                                        {{ replaceEnumUnderscores(findEnumKeyByValue(ProductType, item.product.type)) }}
                                    </div>
                                </template>

                                <template #cell(action)="{ value, item }">
                                    <div class="flex gap-1.5">
                                        <Link
                                            class="border border-gray-300 dark:border-gray-700 rounded-md p-1 active:scale-90 transition"
                                            :title="'Покажи продукт'"
                                            :href="route('products.show', item.product_id)"
                                        >
                                            <DocumentText
                                                classes="w-4 h-4 text-[#909090]"
                                            />
                                        </Link>
                                    </div>
                                </template>
                            </Table>
                        </div>
                    </Accordion>
                </div>

                <ChangeLogs
                    :change-logs-limited="project.change_logs_limited"
                    :change-logs="changeLogs"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
