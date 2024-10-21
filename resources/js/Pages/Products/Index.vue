<script setup lang="ts">
import {Head, Link, useForm} from "@inertiajs/vue3";
import {ref} from "vue";

import ModalSaveButtons from "@/Components/HTML/ModalSaveButtons.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import TextInput from "@/Components/TextInput.vue";
import Table from "@/DataTable/Table.vue";
import {DataTable} from "@/DataTable/types";
import IconPencilSquare from "@/Icons/PencilSquare.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Product, ProductForm, ProductFranceForm} from "@/types";
import {dateTimeToLocaleString} from "@/utils";



defineProps<{
    dataTable: DataTable<Product>;
}>();

const showChangeQuantityFranceModal = ref(false);

const openChangeQuantityFranceModal = (item: Product) => {
    storeFormFrance.id = item.id;
    storeFormFrance.name = item.name;
    storeFormFrance.quantity_france = item.quantity_france;

    showChangeQuantityFranceModal.value = true;
};

const closeChangeQuantityFranceModal = () => {
    showChangeQuantityFranceModal.value = false;
    storeFormFrance.reset();
};

const storeFormFrance = useForm<ProductFranceForm>({
    id: null!,
    name: null!,
    quantity_france: null!,
});

const handleFranceUpdate = () => {
    storeFormFrance.put(route("items.update", storeFormFrance.id as number), {
        preserveScroll: true,
        onSuccess: () => {
            closeChangeQuantityFranceModal();
            storeFormFrance.reset();
        },
        onError: () => {
        },
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

                            <template #cell(quantity_france)="{ value, item }">
                                <span
                                    class="cursor-pointer"
                                    @click="openChangeQuantityFranceModal(item)"
                                >
                                    {{ value }}
                                </span>
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
        :show="showChangeQuantityFranceModal"
        @close="closeChangeQuantityFranceModal"
    >
        <div
            class="border-b border-[#E9E7E7] px-3.5 p-3 text-xl font-medium"
        >
            <div>Change quantity of product # {{ storeFormFrance?.id }}</div>
            <div>{{ storeFormFrance?.name }}</div>
        </div>

        <div class="p-6">
            <InputLabel
                for="quantity_france"
                value="Quantity France"
            />

            <TextInput
                id="quantity_france"
                v-model="storeFormFrance.quantity_france"
                type="number"
                step="1"
                class="mt-1 block w-full"
            />

            <InputError
                class="mt-2"
                :message="storeFormFrance.errors.quantity_france"
            />
        </div>

        <ModalSaveButtons
            :processing="storeFormFrance.processing"
            @cancel="closeChangeQuantityFranceModal"
            @save="handleFranceUpdate"
        />
    </Modal>
</template>
