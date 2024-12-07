<script setup lang="ts">
import {Head, Link} from "@inertiajs/vue3";

import Accordion from "@/Components/HTML/Accordion.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Select from "@/Components/Select.vue";
import Table from "@/DataTable/Table.vue";
import {DataTable} from "@/DataTable/types";
import {ProductRequestStatus} from "@/Enums/ProductRequestStatus";
import {ProductType} from "@/Enums/ProductType";
import {Warehouse} from "@/Enums/Warehouse";
import DocumentText from "@/Icons/DocumentText.vue";
import IconPencilSquare from "@/Icons/PencilSquare.vue";
import Tick from "@/Icons/Tick.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ProductProductRequest, ProductRequest} from "@/types";
import {findEnumKeyByValue, replaceEnumUnderscores} from "@/utils";

defineProps<{
    productRequest: ProductRequest;
    dataTable: DataTable<ProductProductRequest>;
}>();

const statuses = Object.entries(ProductRequestStatus)
    .filter(([name]) => isNaN(Number(name)))
    .map(([name, value]) => ({
        name,
        value,
    }));
</script>

<template>
    <Head :title="'Product Request'" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Product Request
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="relative rounded-lg shadow-sm bg-white dark:bg-gray-800 py-4 sm:py-6 px-4"
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
                                <template #cell(product.type)="{ value, item }">
                                    <div class="flex gap-1.5">
                                        {{ replaceEnumUnderscores(findEnumKeyByValue(ProductType, item.product.type)) }}
                                    </div>
                                </template>

                                <template #cell(action)="{ value, item }">
                                    <div class="flex gap-1.5">
                                        <Link
                                            class="border border-[#E9E7E7] dark:border-gray-700 rounded-md p-1 active:scale-90 transition"
                                            :title="'Edit product'"
                                            :href="route('products.edit', item.product_id)"
                                        >
                                            <IconPencilSquare
                                                classes="w-4 h-4 text-[#909090]"
                                            />
                                        </Link>

                                        <Link
                                            class="border border-gray-300 dark:border-gray-700 rounded-md p-1 active:scale-90 transition"
                                            :title="'Show product'"
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

                <div
                    class="bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 mt-4"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="grid lg:grid-cols-1 xl:grid-cols-2 gap-4">
                            <div class="mt-6 space-y-6">
                                <div>
                                    <InputLabel
                                        for="warehouse"
                                        value="To Warehouse"
                                    />

                                    <Select
                                        id="warehouse"
                                        v-model="productRequest.warehouse"
                                        :name="'warehouse'"
                                        :options="Warehouse"
                                        :placeholder="'To Warehouse'"
                                        disabled
                                        class="mt-1 block w-full mb-3.5"
                                    />
                                </div>

                                <div class="p-2 pt-8">
                                    <ol class="flex items-center">
                                        <li
                                            v-for="(status, index) in statuses"
                                            :key="index"
                                            class="relative w-full mb-6"
                                        >
                                            <div class="flex items-center">
                                                <div
                                                    class="z-10 flex items-center justify-center w-6 h-6  rounded-full ring-0 ring-white  sm:ring-8 dark:ring-gray-900 shrink-0"
                                                    :class="{
                                                        'bg-blue-600 dark:bg-blue-900': productRequest.status >= (status.value as number),
                                                        'bg-gray-200 dark:bg-gray-700': productRequest.status < (status.value as number),
                                                    }"
                                                >
                                                    <Tick />
                                                </div>
                                                <div
                                                    v-if="(status.value as number) < statuses.length"
                                                    class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"
                                                />
                                            </div>
                                            <div class="mt-3">
                                                <h3
                                                    class="font-medium"
                                                    :class="{
                                                        'text-gray-900 dark:text-white': productRequest.status >= (status.value as number),
                                                        'text-gray-200 dark:text-gray-700': productRequest.status < (status.value as number),
                                                    }"
                                                >
                                                    {{ replaceEnumUnderscores(status.name) }}
                                                </h3>
                                            </div>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>