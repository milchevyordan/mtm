<script setup lang="ts">
import {Head, Link, useForm, usePage} from "@inertiajs/vue3";

import Accordion from "@/Components/HTML/Accordion.vue";
import ResetSaveButtons from "@/Components/HTML/ResetSaveButtons.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Select from "@/Components/Select.vue";
import TextInput from "@/Components/TextInput.vue";
import Table from "@/DataTable/Table.vue";
import {DataTable} from "@/DataTable/types";
import {ProductType} from "@/Enums/ProductType";
import {Warehouse} from "@/Enums/Warehouse";
import DocumentText from "@/Icons/DocumentText.vue";
import IconMinus from "@/Icons/Minus.vue";
import IconPencilSquare from "@/Icons/PencilSquare.vue";
import IconPlus from "@/Icons/Plus.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Product, ProductRequestForm} from "@/types";
import {dateTimeToLocaleString, findEnumKeyByValue, replaceEnumUnderscores} from "@/utils";

defineProps<{
    dataTable: DataTable<Product>;
}>();

const form = useForm<ProductRequestForm>({
    id: null!,
    warehouse: usePage().props.auth.user.warehouse != Warehouse.Varna ? usePage().props.auth.user.warehouse : null!,
    products: [],
    productIds: [],
});

const save = async (only?: Array<string>) => {
    return new Promise<void>((resolve, reject) => {
        form.post(route("product-requests.store"), {
            preserveScroll: true,
            preserveState: true,
            only: only,
            onSuccess: () => {
                resolve();
            },
            onError: () => {
                reject(new Error("Error, during update"));
            },
        });
    });
};

const addProduct = (item: Product) => {
    const resultObject = {
        [item.id]: {
            product_id: item.id,
            quantity: null!,
        },
    };

    form.products = { ...form.products, ...resultObject };
    form.productIds.push(item.id);
};

const removeProduct = (id: number) => {
    const formIndex = form.productIds.indexOf(id);

    if (form.products.hasOwnProperty(id)) {
        delete form.products[id];
    }

    if (formIndex !== -1) {
        form.productIds.splice(formIndex, 1);
    }
};

const filteredWarehouse = Object.fromEntries(
    Object.entries(Warehouse).filter(([key]) => isNaN(Number(key)) && key !== 'Varna')
);
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
                                Products
                            </div>
                        </template>

                        <div class="text-gray-900 dark:text-gray-100">
                            <Table
                                :data-table="dataTable"
                                :per-page-options="[5, 10, 15, 20, 50]"
                                :global-search="true"
                                :advanced-filters="false"
                                :type-search="true"
                                :selected-row-indexes="form.productIds"
                                :selected-row-column="'id'"
                            >
                                <template #cell(created_at)="{ value, item }">
                                    <div class="flex gap-1.5">
                                        {{ dateTimeToLocaleString(value) }}
                                    </div>
                                </template>

                                <template #cell(type)="{ value, item }">
                                    <div class="flex gap-1.5">
                                        {{ replaceEnumUnderscores(findEnumKeyByValue(ProductType, value)) }}
                                    </div>
                                </template>

                                <template #cell(quantity_varna)="{ value, item }">
                                    <div
                                        class="text-center rounded"
                                        :class="{
                                            'bg-red-500 text-white': (value[0]?.quantity ?? null) < item.minimum_quantity,
                                        }"
                                    >
                                        {{ value[0]?.quantity ?? '' }}
                                    </div>
                                </template>

                                <template #cell(quantity_france)="{ value, item }">
                                    <div
                                        class="text-center rounded"
                                        :class="{
                                            'bg-red-500 text-white': (value[0]?.quantity ?? null) < item.minimum_quantity,
                                        }"
                                    >
                                        {{ value[0]?.quantity ?? '' }}
                                    </div>
                                </template>

                                <template #cell(quantity_netherlands)="{ value, item }">
                                    <div
                                        class="text-center rounded"
                                        :class="{
                                            'bg-red-500 text-white': (value[0]?.quantity ?? null) < item.minimum_quantity,
                                        }"
                                    >
                                        {{ value[0]?.quantity ?? '' }}
                                    </div>
                                </template>

                                <template #cell(action)="{ value, item }">
                                    <div class="flex gap-1.5">
                                        <button
                                            v-if="form.productIds.includes(item.id)"
                                            class="border border-[#E9E7E7] dark:border-gray-700 rounded-md p-1 active:scale-90 transition"
                                            @click="removeProduct(item.id)"
                                        >
                                            <IconMinus
                                                classes="w-4 h-4 text-[#909090]"
                                            />
                                        </button>
                                        <button
                                            v-else
                                            class="border border-[#E9E7E7] dark:border-gray-700 rounded-md p-1 active:scale-90 transition"
                                            @click="addProduct(item)"
                                        >
                                            <IconPlus
                                                classes="w-4 h-4 text-[#909090]"
                                            />
                                        </button>
                                        <Link
                                            class="border border-[#E9E7E7] dark:border-gray-700 rounded-md p-1 active:scale-90 transition"
                                            :title="'Edit product'"
                                            :href="route('products.edit', item.id)"
                                        >
                                            <IconPencilSquare
                                                classes="w-4 h-4 text-[#909090]"
                                            />
                                        </Link>

                                        <Link
                                            class="border border-gray-300 dark:border-gray-700 rounded-md p-1 active:scale-90 transition"
                                            :title="'Show product'"
                                            :href="route('products.show', item.id)"
                                        >
                                            <DocumentText
                                                classes="w-4 h-4 text-[#909090]"
                                            />
                                        </Link>
                                    </div>

                                    <div
                                        v-if="form.productIds.includes(item.id)"
                                        class="flex-col gap-1.5 pt-2 min-w-[150px]"
                                    >
                                        <TextInput
                                            :id="'quantities_' + item.id"
                                            v-model="form.products[item.id].quantity"
                                            type="number"
                                            :placeholder="'Order Quantity'"
                                            step="1"
                                            class="block w-full"
                                        />

                                        <InputError
                                            class="mt-2"
                                            :message="form.errors['products.' + item.id + '.quantity']"
                                        />
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
                            <form
                                class="mt-6 space-y-6"
                                @submit.prevent="save()"
                            >
                                <div>
                                    <InputLabel
                                        for="warehouse"
                                        value="To Warehouse"
                                    />

                                    <Select
                                        id="warehouse"
                                        v-model="form.warehouse"
                                        :name="'warehouse'"
                                        :options="filteredWarehouse"
                                        :placeholder="'To Warehouse'"
                                        class="mt-1 block w-full mb-3.5"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.warehouse"
                                    />
                                </div>

                                <ResetSaveButtons
                                    :processing="form.processing"
                                    :recently-successful="form.recentlySuccessful"
                                    @reset="form.reset()"
                                />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>