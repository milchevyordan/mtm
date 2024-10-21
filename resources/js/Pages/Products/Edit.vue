<script setup lang="ts">
import {Head, useForm} from "@inertiajs/vue3";

import ChangeLogs from "@/Components/HTML/ChangeLogs.vue";
import ResetSaveButtons from "@/Components/HTML/ResetSaveButtons.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Product, ProductForm} from "@/types";
import {withFlash} from "@/utils";

const props = defineProps<{
    product: Product;
}>();

const form = useForm<ProductForm>({
    _method: "put",
    id: props.product.id,
    name: props.product.name,
    internal_id: props.product.internal_id,
    minimum_quantity: props.product.minimum_quantity,
    quantity_france: props.product.quantity_france,
    quantity_netherlands: props.product.quantity_netherlands,
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
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
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
                                        autofocus
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

                                <div>
                                    <InputLabel
                                        for="quantity_france"
                                        value="Quantity France"
                                    />

                                    <TextInput
                                        id="quantity_france"
                                        v-model="form.quantity_france"
                                        type="number"
                                        step="1"
                                        class="mt-1 block w-full"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.quantity_france"
                                    />
                                </div>

                                <div>
                                    <InputLabel
                                        for="quantity_netherlands"
                                        value="Quantity Netherlands"
                                    />

                                    <TextInput
                                        id="quantity_netherlands"
                                        v-model="form.quantity_netherlands"
                                        type="number"
                                        step="1"
                                        class="mt-1 block w-full"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.quantity_netherlands"
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
