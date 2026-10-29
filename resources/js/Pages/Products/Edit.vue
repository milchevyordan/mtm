<script setup lang="ts">
import {Head, Link, router, useForm} from "@inertiajs/vue3";
import {ref, watch} from "vue";

import Creator from "@/Components/Creator.vue";
import Accordion from "@/Components/HTML/Accordion.vue";
import ChangeLogs from "@/Components/HTML/ChangeLogs.vue";
import ResetSaveButtons from "@/Components/HTML/ResetSaveButtons.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import Select from "@/Components/Select.vue";
import TextInput from "@/Components/TextInput.vue";
import Table from "@/DataTable/Table.vue";
import {DataTable, Multiselect} from "@/DataTable/types";
import {ProductType} from "@/Enums/ProductType";
import {Warehouse} from "@/Enums/Warehouse";
import Move from "@/Icons/Move.vue";
import IconPencilSquare from "@/Icons/PencilSquare.vue";
import IconTrash from "@/Icons/Trash.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {
    ChangeLog,
    DeleteForm,
    Product,
    ProductForm,
    ProductProject,
    ProductProjectForm,
    ProductQuantity, Project, SelectInput
} from "@/types";
import {dateTimeToLocaleString, findEnumKeyByValue, findKeyByValue, warehouses, withFlash} from "@/utils";

const props = defineProps<{
    product: Product;
    dataTable: DataTable<ProductProject>;
    changeLogs?: DataTable<ChangeLog>;
    projects?: Multiselect<Project>;
    projectWarehouse?: Record<number, number>;
}>();

const getWarehouseQuantity = (quantities: ProductQuantity[] | undefined, warehouse: Warehouse): number | null => {
    return quantities?.find((item) => item.warehouse === warehouse)?.quantity ?? null!;
};

const form = useForm<ProductForm>({
    _method: "put",
    id: props.product.id,
    name: props.product.name,
    specification: props.product.specification,
    type: props.product.type,
    internal_id: props.product.internal_id,
    minimum_quantity: props.product.minimum_quantity,
    quantities: {
        Varna: getWarehouseQuantity(props.product.quantity, Warehouse.Varna),
        France: getWarehouseQuantity(props.product.quantity, Warehouse.France),
        Netherlands: getWarehouseQuantity(props.product.quantity, Warehouse.Netherlands),
        Belgium: getWarehouseQuantity(props.product.quantity, Warehouse.Belgium),
    }
});

watch(
    () => props.product.quantity,
    (newQuantities) => {
        form.quantities.Varna = getWarehouseQuantity(newQuantities, Warehouse.Varna);
        form.quantities.France = getWarehouseQuantity(newQuantities, Warehouse.France);
        form.quantities.Netherlands = getWarehouseQuantity(newQuantities, Warehouse.Netherlands);
        form.quantities.Belgium = getWarehouseQuantity(newQuantities, Warehouse.Belgium);
    }
);

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

const showDeleteModal = ref<boolean>(false);

const closeDeleteModal = () => {
    showDeleteModal.value = false;
    deleteForm.reset();
};

const showDeleteForm = (item: ProductProject) => {
    deleteForm.id = item.id as number;
    deleteForm.name = item.project?.name as string;
    deleteForm.created_at = item.created_at as Date;

    showDeleteModal.value = true;
};

const deleteForm = useForm<DeleteForm>({
    id: null!,
    name: null!,
    created_at: null!,
});

const handleDelete = () => {
    deleteForm.delete(route("projects.destroy-product"), {
        preserveScroll: true,
    });
    closeDeleteModal();
};

const showAddToProjectModal = ref(false);

const closeAddToProjectModal = () => {
    showAddToProjectModal.value = false;
    moveToProjectForm.reset();
};

const moveToProjectForm = useForm<ProductProjectForm>({
    id: null!,
    product_id: props.product.id,
    project_id: null!,
    quantity: null!,
    available_quantity: null!,
    warehouse: null!,
    comment: null!
});

const updateAvailableQuantity = (input: SelectInput) => {
    if (!props.projectWarehouse){
        return;
    }

    moveToProjectForm.warehouse = props.projectWarehouse[input.value as number] ?? null!;
};

const openMoveToProjectModal = async (item: ProductProject) => {
    moveToProjectForm.id = item.id;
    moveToProjectForm.quantity = item.quantity;
    moveToProjectForm.comment = item.comment;

    if (!props.projects || !props.projectWarehouse) {
        await new Promise((resolve, reject) => {
            router.reload({
                only: ["projects", "projectWarehouse"],
                onSuccess: resolve,
                onError: reject,
            });
        });
    }

    showAddToProjectModal.value = true;
};

const handleAddProductToProject = () => {
    return new Promise<void>((resolve, reject) => {
        moveToProjectForm.post(
            route("products.move-to-project"),
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
        closeAddToProjectModal();
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
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
                <div
                    class="bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">
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
                                        for="specification"
                                        value="Спецификация"
                                    />

                                    <TextInput
                                        id="specification"
                                        v-model="form.specification"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        autocomplete="specification"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.specification"
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
                                        value="Вътрешен №"
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

                            <Creator :creator-name="product.creator?.name" />
                        </div>

                        <div class="w-full flex gap-2">
                            <Link
                                class="w-full md:w-auto border border-gray-300 dark:border-gray-700 rounded-md px-5 py-1.5 active:scale-95 transition hover:bg-gray-50 dark:hover:bg-gray-800"
                                :href="route('products.create')"
                            >
                                Създай Нов Продукт
                            </Link>
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
                                Зачисления
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
                                            class="border border-[#E9E7E7] dark:border-gray-700 rounded-md p-1 active:scale-90 transition"
                                            :title="'Редактирай проект'"
                                            :href="route('projects.edit', item.project_id)"
                                        >
                                            <IconPencilSquare
                                                classes="w-4 h-4 "
                                            />
                                        </Link>

                                        <button
                                            class="border border-[#E9E7E7] dark:border-gray-700 rounded-md p-1 active:scale-90 transition"
                                            :title="'Премести към проект'"
                                            @click="openMoveToProjectModal(item)"
                                        >
                                            <Move
                                                classes="w-4 h-4 "
                                            />
                                        </button>

                                        <button
                                            :title="'Изтрий'"
                                            class="border border-[#E9E7E7] dark:border-gray-700 rounded-md p-1 active:scale-90 transition"
                                            @click="showDeleteForm(item)"
                                        >
                                            <IconTrash classes="w-4 h-4 " />
                                        </button>
                                    </div>
                                </template>
                            </Table>
                        </div>
                    </Accordion>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <Modal
        :show="showAddToProjectModal"
        max-width="lg"
        @close="closeAddToProjectModal"
    >
        <div
            class="border-b border-gray-100 dark:border-gray-700 px-3.5 p-3 text-xl font-medium"
        >
            <div>Премести продукт <span class="font-bold">{{ form.name }}</span> към проект</div>
        </div>

        <form
            class="p-6"
            @submit.prevent="handleAddProductToProject"
        >
            <div>
                <InputLabel
                    for="project"
                    :value="'Проект'"
                />

                <Select
                    v-model="moveToProjectForm.project_id"
                    :name="'project_id'"
                    :options="projects"
                    :placeholder="'Проект'"
                    class="mt-1 block w-full mb-3.5"
                    @select="updateAvailableQuantity"
                />

                <InputError
                    class="mt-2"
                    :message="moveToProjectForm.errors.project_id"
                />
            </div>

            <div>
                <InputLabel
                    for="quantity"
                    :value="`Количество да се добави към ${findKeyByValue(props.projects, moveToProjectForm.project_id) ?? 'проект'}`"
                />

                <TextInput
                    id="quantity"
                    v-model="moveToProjectForm.quantity"
                    type="number"
                    :placeholder="'Количество да се добави'"
                    step="1"
                    :min="1"
                    disabled
                    :max="moveToProjectForm.available_quantity"
                    class="mt-1 block w-full mb-3.5"
                />

                <InputError
                    class="mt-2"
                    :message="moveToProjectForm.errors.quantity"
                />
            </div>

            <div>
                <InputLabel
                    for="comment"
                    :value="'Коментар'"
                />

                <TextInput
                    id="comment"
                    v-model="moveToProjectForm.comment"
                    type="text"
                    :placeholder="'Напиши Коментар'"
                    disabled
                    class="mt-1 block w-full"
                />

                <InputError
                    class="mt-2"
                    :message="moveToProjectForm.errors.quantity"
                />
            </div>

            <div class="col-span-2 flex justify-end gap-3 my-2 pt-1 px-4">
                <ResetSaveButtons
                    :processing="moveToProjectForm.processing"
                    :recently-successful="moveToProjectForm.recentlySuccessful"
                    @reset="closeAddToProjectModal"
                />
            </div>
        </form>
    </Modal>

    <Modal
        :show="showDeleteModal"
        @close="closeDeleteModal"
    >
        <div
            class="border-b border-gray-100 dark:border-gray-700 px-3.5 p-3 text-xl font-medium"
        >
            Изтрии проекта {{ deleteForm?.name ?? '' }} зачислен на {{ dateTimeToLocaleString(deleteForm?.created_at) }} ?
        </div>

        <form
            class="col-span-2 flex justify-end gap-3 my-2 pt-1 px-4"
            @submit.prevent="handleDelete"
        >
            <ResetSaveButtons
                :processing="deleteForm.processing"
                :recently-successful="deleteForm.recentlySuccessful"
                :is-delete="true"
                @reset="deleteForm.reset()"
            />
        </form>
    </Modal>
</template>
