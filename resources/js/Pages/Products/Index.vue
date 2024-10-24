<script setup lang="ts">
import {Head, Link, useForm} from "@inertiajs/vue3";
import {ref} from "vue";

import ResetSaveButtons from "@/Components/HTML/ResetSaveButtons.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import TextInput from "@/Components/TextInput.vue";
import Table from "@/DataTable/Table.vue";
import {DataTable} from "@/DataTable/types";
import {Warehouse} from "@/Enums/Warehouse";
import IconPencilSquare from "@/Icons/PencilSquare.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Product, ProductQuantity, ProductQuantityForm} from "@/types";
import {dateTimeToLocaleString, findEnumKeyByValue} from "@/utils";

defineProps<{
    dataTable: DataTable<Product>;
}>();

const showChangeQuantityModal = ref(false);

const closeChangeQuantityModal = () => {
    showChangeQuantityModal.value = false;
    updateQuantityForm.reset();
};

const updateQuantityForm = useForm<ProductQuantityForm>({
    _method: "put",
    id: null!,
    product_id: null!,
    warehouse: null!,
    quantity: null!
});

const openChangeQuantityModal = (item: ProductQuantity) => {
    updateQuantityForm.id = item.id;
    updateQuantityForm.product_id = item.product_id;
    updateQuantityForm.warehouse = item.warehouse;
    updateQuantityForm.quantity = item.quantity;

    showChangeQuantityModal.value = true;
};

const handleQuantityUpdate = () => {
    return new Promise<void>((resolve, reject) => {
        updateQuantityForm.post(
            route("products.update-quantity", updateQuantityForm.id as number),
            {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    resolve();
                },
                onError: () => {
                    reject();
                },
            }
        );
        closeChangeQuantityModal();
    });
};
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
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
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
                                        :href="route('products.create')"
                                    >
                                        Create Product
                                    </Link>
                                </div>
                            </template>

                            <template #cell(created_at)="{ value, item }">
                                <div class="flex gap-1.5">
                                    {{ dateTimeToLocaleString(value) }}
                                </div>
                            </template>

                            <template #cell(quantity_varna)="{ value, item }">
                                <div
                                    class="cursor-pointer text-center rounded"
                                    :class="{
                                        'bg-red-500 text-white': (value[0]?.quantity ?? null) < item.minimum_quantity,
                                        'bg-transparent': (value[0]?.quantity ?? null) >= item.minimum_quantity
                                    }"
                                    @click="openChangeQuantityModal(value[0] ?? null)"
                                >
                                    {{ value[0].quantity ?? '' }}
                                </div>
                            </template>

                            <template #cell(quantity_france)="{ value, item }">
                                <div
                                    class="cursor-pointer text-center rounded"
                                    :class="{
                                        'bg-red-500 text-white': (value[0]?.quantity ?? null) < item.minimum_quantity,
                                        'bg-transparent': (value[0]?.quantity ?? null) >= item.minimum_quantity
                                    }"
                                    @click="openChangeQuantityModal(value[0] ?? null)"
                                >
                                    {{ value[0].quantity ?? '' }}
                                </div>
                            </template>

                            <template #cell(quantity_netherlands)="{ value, item }">
                                <div
                                    class="cursor-pointer text-center rounded"
                                    :class="{
                                        'bg-red-500 text-white': (value[0]?.quantity ?? null) < item.minimum_quantity,
                                        'bg-transparent': (value[0]?.quantity ?? null) >= item.minimum_quantity
                                    }"
                                    @click="openChangeQuantityModal(value[0] ?? null)"
                                >
                                    {{ value[0].quantity ?? '' }}
                                </div>
                            </template>

                            <template #cell(action)="{ value, item }">
                                <div class="flex gap-1.5">
                                    <Link
                                        class="border border-[#E9E7E7] rounded-md p-1 active:scale-90 transition"
                                        :title="'Edit product'"
                                        :href="route('products.edit', item.id)"
                                    >
                                        <IconPencilSquare
                                            classes="w-4 h-4 text-[#909090]"
                                        />
                                    </Link>
                                </div>
                            </template>
                        </Table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <Modal
        :show="showChangeQuantityModal"
        max-width="lg"
        @close="closeChangeQuantityModal"
    >
        <div
            class="border-b border-gray-100 dark:border-gray-700 px-3.5 p-3 text-xl font-medium"
        >
            <div>Change quantity of product # {{ updateQuantityForm?.product_id }}</div>
        </div>

        <form
            class="p-6"
            @submit.prevent="handleQuantityUpdate"
        >
            <div>
                <InputLabel
                    for="quantity"
                    :value="`Quantity ${findEnumKeyByValue(Warehouse, updateQuantityForm?.warehouse)}`"
                />

                <TextInput
                    id="quantity"
                    v-model="updateQuantityForm.quantity"
                    type="number"
                    step="1"
                    class="mt-1 block w-full"
                />

                <InputError
                    class="mt-2"
                    :message="updateQuantityForm.errors.quantity"
                />
            </div>

            <div class="col-span-2 flex justify-end gap-3 mt-2 pt-1 px-4">
                <ResetSaveButtons
                    :processing="updateQuantityForm.processing"
                    :recently-successful="updateQuantityForm.recentlySuccessful"
                    @reset="updateQuantityForm.reset()"
                />
            </div>
        </form>
    </Modal>
</template>
