<script setup lang="ts">
import {Head, useForm} from "@inertiajs/vue3";

import ResetSaveButtons from "@/Components/HTML/ResetSaveButtons.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ProductForm} from "@/types";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";

const form = useForm<ProductForm>({
    id: null!,
    internal_id: null!,
    name: null!,
    minimum_quantity: 10,
    quantity_france: null!,
    quantity_netherlands: null!,
});

const save = async (only?: Array<string>) => {
    return new Promise<void>((resolve, reject) => {
        form.post(route("products.store"), {
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
</script>

<template>
    <Head :title="'Product'"/>

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
                        <div class="grid lg:grid-cols-1 xl:grid-cols-2 gap-4">
                            <form
                                class="mt-6 space-y-6"
                                @submit.prevent="save()"
                            >
                                <div>
                                    <InputLabel for="name" value="Name" />

                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.name"
                                        required
                                        autofocus
                                        autocomplete="name"
                                    />

                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>

                                <div>
                                    <InputLabel for="internal_id" value="Internal Id" />

                                    <TextInput
                                        id="internal_id"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.internal_id"
                                    />

                                    <InputError class="mt-2" :message="form.errors.internal_id" />
                                </div>

                                <div>
                                    <InputLabel for="minimum_quantity" value="Minimum Quantity" />

                                    <TextInput
                                        id="minimum_quantity"
                                        type="number"
                                        step="1"
                                        class="mt-1 block w-full"
                                        v-model="form.minimum_quantity"
                                    />

                                    <InputError class="mt-2" :message="form.errors.minimum_quantity" />
                                </div>

                                <div>
                                    <InputLabel for="quantity_france" value="Quantity France" />

                                    <TextInput
                                        id="quantity_france"
                                        type="number"
                                        step="1"
                                        class="mt-1 block w-full"
                                        v-model="form.quantity_france"
                                    />

                                    <InputError class="mt-2" :message="form.errors.quantity_france" />
                                </div>

                                <div>
                                    <InputLabel for="quantity_netherlands" value="Quantity Netherlands" />

                                    <TextInput
                                        id="quantity_netherlands"
                                        type="number"
                                        step="1"
                                        class="mt-1 block w-full"
                                        v-model="form.quantity_netherlands"
                                    />

                                    <InputError class="mt-2" :message="form.errors.quantity_netherlands" />
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
