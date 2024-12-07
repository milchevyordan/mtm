<script setup lang="ts">
import {Head, useForm} from "@inertiajs/vue3";

import ResetSaveButtons from "@/Components/HTML/ResetSaveButtons.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Select from "@/Components/Select.vue";
import TextInput from "@/Components/TextInput.vue";
import {ProductType} from "@/Enums/ProductType";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ProductForm} from "@/types";
import {warehouses} from "@/utils";

const form = useForm<ProductForm>({
    id: null!,
    internal_id: null!,
    name: null!,
    type: null!,
    minimum_quantity: 10,
    quantities: {
        Varna: null!,
        France: null!,
        Netherlands: null!,
    }
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
    <Head :title="'Продукт'" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Продукт
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
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
                                        value="Име"
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
                                        for="type"
                                        value="Тип"
                                    />

                                    <Select
                                        v-model="form.type"
                                        :name="'type'"
                                        :options="ProductType"
                                        :placeholder="'Тип'"
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
                                        value="Вътрешно #"
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
                                        value="Минимално Количество"
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
                                        :value="`Количество ${warehouse.name}`"
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
            </div>
        </div>
    </AuthenticatedLayout>
</template>