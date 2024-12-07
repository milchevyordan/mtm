<script setup lang="ts">
import {Head, Link, useForm} from "@inertiajs/vue3";

import Accordion from "@/Components/HTML/Accordion.vue";
import ChangeLogs from "@/Components/HTML/ChangeLogs.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Select from "@/Components/Select.vue";
import TextInput from "@/Components/TextInput.vue";
import Table from "@/DataTable/Table.vue";
import {DataTable} from "@/DataTable/types";
import {ProductType} from "@/Enums/ProductType";
import {Warehouse} from "@/Enums/Warehouse";
import DocumentText from "@/Icons/DocumentText.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ChangeLog, Product, ProductForm, ProductProject, ProductQuantity} from "@/types";
import {dateTimeToLocaleString, findEnumKeyByValue, warehouses} from "@/utils";

const props = defineProps<{
    product: Product;
    dataTable: DataTable<ProductProject>;
    changeLogs?: DataTable<ChangeLog>;
}>();

const form = useForm<ProductForm>({
    quantities: {
        Varna: props.product.quantity?.find((item: ProductQuantity) => item.warehouse == Warehouse.Varna)?.quantity ?? null!,
        France: props.product.quantity?.find((item: ProductQuantity) => item.warehouse == Warehouse.France)?.quantity ?? null!,
        Netherlands: props.product.quantity?.find((item: ProductQuantity) => item.warehouse == Warehouse.Netherlands)?.quantity ?? null!,
    }
});
</script>

<template>
    <Head :title="'Product'" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Product
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
                <div
                    class="bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="grid lg:grid-cols-1 xl:grid-cols-2 gap-4">
                            <div
                                class="mt-6 space-y-6"
                            >
                                <div>
                                    <InputLabel
                                        for="name"
                                        value="Име"
                                    />

                                    <TextInput
                                        id="name"
                                        :model-value="product.name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        disabled
                                        autocomplete="name"
                                    />
                                </div>

                                <div>
                                    <InputLabel
                                        for="type"
                                        value="Type"
                                    />

                                    <Select
                                        :selected-option-value="product.type"
                                        :name="'type'"
                                        :options="ProductType"
                                        :placeholder="'Type'"
                                        class="mt-1 block w-full mb-3.5"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.type"
                                    />
                                </div>

                                <div>
                                    <InputLabel
                                        for="internal_id"
                                        value="Internal Id"
                                    />

                                    <TextInput
                                        id="internal_id"
                                        :model-value="product.internal_id"
                                        type="text"
                                        disabled
                                        class="mt-1 block w-full"
                                    />
                                </div>

                                <div>
                                    <InputLabel
                                        for="minimum_quantity"
                                        value="Minimum Quantity"
                                    />

                                    <TextInput
                                        id="minimum_quantity"
                                        :model-value="product.minimum_quantity"
                                        type="number"
                                        step="1"
                                        disabled
                                        class="mt-1 block w-full"
                                    />
                                </div>

                                <div
                                    v-for="(warehouse, index) in warehouses"
                                    :key="index"
                                >
                                    <InputLabel
                                        :for="'quantities_' + warehouse.name"
                                        :value="`Quantity ${warehouse.name}`"
                                    />

                                    <TextInput
                                        :id="'quantities_' + warehouse.name"
                                        :model-value="form.quantities[warehouse.name]"
                                        type="number"
                                        step="1"
                                        disabled
                                        class="mt-1 block w-full"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <ChangeLogs
                    :change-logs-limited="product.change_logs_limited"
                    :change-logs="changeLogs"
                />

                <div
                    class="relative rounded-lg shadow-sm bg-white dark:bg-gray-800 py-4 sm:py-6 px-4 mt-4"
                >
                    <Accordion>
                        <template #head>
                            <div class="font-semibold text-xl sm:text-2xl mb-4 text-gray-900 dark:text-gray-100">
                                Projects
                            </div>
                        </template>

                        <div class="text-gray-900 dark:text-gray-100">
                            <Table
                                :data-table="dataTable"
                                :per-page-options="[5, 10, 15, 20, 50]"
                                :global-search="true"
                                :advanced-filters="false"
                            >
                                <template #cell(project.warehouse)="{ value, item }">
                                    <div class="flex gap-1.5">
                                        {{ item.project ? findEnumKeyByValue(Warehouse, item.project.warehouse) : "" }}
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
                                            class="border border-gray-300 dark:border-gray-700 rounded-md p-1 active:scale-90 transition"
                                            :title="'Show project'"
                                            :href="route('projects.show', item.project_id)"
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
            </div>
        </div>
    </AuthenticatedLayout>
</template>
