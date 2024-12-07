<script setup lang="ts">
import {Head, router} from "@inertiajs/vue3";

import Accordion from "@/Components/HTML/Accordion.vue";
import InputLabel from "@/Components/InputLabel.vue";
import SelectMultiple from "@/Components/SelectMultiple.vue";
import TextInput from "@/Components/TextInput.vue";
import Table from "@/DataTable/Table.vue";
import {DataTable, Multiselect} from "@/DataTable/types";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ProductReport, Project, Report} from "@/types";
import {downloadPdf, findEnumKeyByValue, replaceEnumUnderscores} from "@/utils";
import {ProductType} from "@/Enums/ProductType";

const props = defineProps<{
    report: Report;
    projects: Multiselect<Project>;
    dataTable: DataTable<ProductReport>;
    pdfPath?: string;
}>();

const handleDownloadPdf = async () => {
    if (props.report.pdf_path) {
        downloadPdf(props.report.pdf_path);
        return;
    }

    await new Promise((resolve, reject) => {
        router.reload({
            only: ["pdfPath"],
            onSuccess: resolve,
            onError: reject,
        });
    });

    if (props.pdfPath){
        downloadPdf(props.pdfPath);
    }
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
                                        disabled
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
                                        disabled
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
                                <template #additionalContent>
                                    <div class="w-full flex gap-2">
                                        <button
                                            class="w-full md:w-auto border border-gray-300 dark:border-gray-700 rounded-md px-5 py-1.5 active:scale-95 transition hover:bg-gray-50 dark:hover:bg-gray-800"
                                            @click="handleDownloadPdf"
                                        >
                                            Download Pdf
                                        </button>
                                    </div>
                                </template>

                                <template #cell(product.type)="{ value, item }">
                                    <div class="flex gap-1.5">
                                        {{ replaceEnumUnderscores(findEnumKeyByValue(ProductType, item.product.type)) }}
                                    </div>
                                </template>
                            </Table>
                        </div>
                    </Accordion>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>