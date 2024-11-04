<script setup lang="ts">
import {Head, useForm} from "@inertiajs/vue3";

import ChangeLogs from "@/Components/HTML/ChangeLogs.vue";
import ResetSaveButtons from "@/Components/HTML/ResetSaveButtons.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import {Warehouse} from "@/Enums/Warehouse";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Product, ProductForm, ProductQuantity} from "@/types";
import {warehouses, withFlash} from "@/utils";

const props = defineProps<{
    product: Product;
}>();

const form = useForm<ProductForm>({
    _method: "put",
    id: props.product.id,
    name: props.product.name,
    internal_id: props.product.internal_id,
    minimum_quantity: props.product.minimum_quantity,
    quantities: {
        Varna: props.product.quantity?.find((item: ProductQuantity) => item.warehouse == Warehouse.Varna)?.quantity ?? null!,
        France: props.product.quantity?.find((item: ProductQuantity) => item.warehouse == Warehouse.France)?.quantity ?? null!,
        Netherlands: props.product.quantity?.find((item: ProductQuantity) => item.warehouse == Warehouse.Netherlands)?.quantity ?? null!,
    }
});

const save = async (only?: Array<string>) => {
    return new Promise<void>((resolve, reject) => {
        form.post(route("products.update", props.product.id as number), {
            preserveScroll: true,
            preserveState: true,
            forceFormData: true, // preserves all form data
            only: withFlash(only),
            onSuccess: () => {
                resolve();
            },
            onError: () => {
                reject(new Error("Error, during update"));
            },
        });
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
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
                <div
                    class="bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="grid lg:grid-cols-1 xl:grid-cols-2 gap-4">
                            <form
                                class="mt-6 space-y-6"
                                @submit.prevent="save()"
                            >
                                <div>
                                    <InputLabel
                                        for="name"
                                        value="Name"
                                    />

                                    <TextInput
                                        id="name"
                                        v-model="form.name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        autocomplete="name"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.name"
                                    />
                                </div>

                                <div>
                                    <InputLabel
                                        for="internal_id"
                                        value="Internal Id"
                                    />

                                    <TextInput
                                        id="internal_id"
                                        v-model="form.internal_id"
                                        type="text"
                                        class="mt-1 block w-full"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.internal_id"
                                    />
                                </div>

                                <div>
                                    <InputLabel
                                        for="minimum_quantity"
                                        value="Minimum Quantity"
                                    />

                                    <TextInput
                                        id="minimum_quantity"
                                        v-model="form.minimum_quantity"
                                        type="number"
                                        step="1"
                                        class="mt-1 block w-full"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.minimum_quantity"
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
                                        v-model="form.quantities[warehouse.name]"
                                        type="number"
                                        step="1"
                                        class="mt-1 block w-full"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors['quantities.' + warehouse.name]"
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

                <ChangeLogs :change-logs="product.change_logs" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
