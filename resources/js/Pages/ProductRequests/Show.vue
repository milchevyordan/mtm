<script setup lang="ts">
import {Head} from "@inertiajs/vue3";

import Accordion from "@/Components/HTML/Accordion.vue";
import InputLabel from "@/Components/InputLabel.vue";
import SelectMultiple from "@/Components/SelectMultiple.vue";
import TextInput from "@/Components/TextInput.vue";
import Table from "@/DataTable/Table.vue";
import {DataTable, Multiselect} from "@/DataTable/types";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ProductReport, Project, Report} from "@/types";

defineProps<{
    report: Report;
    projects: Multiselect<Project>;
    dataTable: DataTable<ProductReport>
}>();
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
                        <div class="grid lg:grid-cols-1 xl:grid-cols-2 gap-4">
                            <div class="mt-6 space-y-6">
                                <div>
                                    <InputLabel
                                        for="date_from"
                                        value="Date From"
                                    />

                                    <TextInput
                                        id="date_from"
                                        :model-value="report.date_from"
                                        type="date"
                                        class="mt-1 block w-full"
                                        required
                                    />
                                </div>

                                <div>
                                    <InputLabel
                                        for="date_to"
                                        value="Date To"
                                    />

                                    <TextInput
                                        id="date_to"
                                        :model-value="report.date_to"
                                        type="date"
                                        class="mt-1 block w-full"
                                        required
                                    />
                                </div>

                                <div>
                                    <InputLabel
                                        for="projects"
                                        value="Projects"
                                    />

                                    <SelectMultiple
                                        id="warehouse"
                                        :selected-options-values="(report.projects as Project[]).map((project) => project.id)"
                                        :name="'projects'"
                                        :multiple="true"
                                        :options="projects"
                                        disabled
                                        :placeholder="'Projects'"
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
                                Products
                            </div>
                        </template>

                        <div class="text-gray-900 dark:text-gray-100">
                            <Table
                                :data-table="dataTable"
                                :per-page-options="[5, 10, 15, 20, 50]"
                                :global-search="true"
                                :advanced-filters="false"
                            />
                        </div>
                    </Accordion>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>