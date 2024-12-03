<script setup lang="ts">
import {Head, Link, useForm, router} from "@inertiajs/vue3";
import {ref} from "vue";

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
import IconDocument from "@/Icons/Document.vue";
import DocumentText from "@/Icons/DocumentText.vue";
import IconPencilSquare from "@/Icons/PencilSquare.vue";
import Plus from "@/Icons/Plus.vue";
import IconTrash from "@/Icons/Trash.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {
    DeleteForm,
    Product, ProductProject,
    ProductProjectForm,
    ProductQuantity,
    ProductQuantityForm,
    Project,
    SelectInput
} from "@/types";
import {
    dateTimeToLocaleString,
    findEnumKeyByValue,
    findKeyByValue, replaceEnumUnderscores
} from "@/utils";

const props = defineProps<{
    dataTable: DataTable<Product>;
    projects?: Multiselect<Project>;
    projectWarehouse?: Record<number, number>;
    showProjectsDataTable?: DataTable<ProductProject>;
}>();

const showProjectsDataTableModal = ref<boolean>(false);

const closeProjectsDataTableModal = () => {
    showProjectsDataTableModal.value = false;
};

const openShowProjectsDataTableModal = async (id: number) => {
    await new Promise((resolve, reject) => {
        router.reload({
            data: { product_id: id },
            only: ["showProjectsDataTable"],
            onSuccess: resolve,
            onError: reject,
        });
    });

    showProjectsDataTableModal.value = true;
};

const showChangeQuantityModal = ref(false);
const showAddToProjectModal = ref(false);

const closeChangeQuantityModal = () => {
    showChangeQuantityModal.value = false;
    updateQuantityForm.reset();
};

const closeAddToProjectModal = () => {
    showAddToProjectModal.value = false;
    addToProjectForm.reset();
};

const updateQuantityForm = useForm<ProductQuantityForm>({
    _method: "put",
    id: null!,
    product_id: null!,
    warehouse: null!,
    quantity: null!
});

const addToProjectForm = useForm<ProductProjectForm>({
    product_id: null!,
    project_id: null!,
    quantity: null!,
    available_quantity: null!,
    warehouse: null!,
    quantities: null!
});

const openChangeQuantityModal = (item: ProductQuantity) => {
    updateQuantityForm.id = item.id;
    updateQuantityForm.product_id = item.product_id;
    updateQuantityForm.warehouse = item.warehouse;
    updateQuantityForm.quantity = item.quantity;

    showChangeQuantityModal.value = true;
};

const openAddToProjectModal = async (item: Product) => {
    addToProjectForm.product_id = item.id;
    addToProjectForm.quantities = item.quantity;

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

const updateAvailableQuantity = (input: SelectInput) => {
    if (!props.projectWarehouse){
        return;
    }

    addToProjectForm.warehouse = props.projectWarehouse[input.value as number] ?? null!;
    addToProjectForm.available_quantity = addToProjectForm.quantities.find((item: ProductQuantity) => item.warehouse == addToProjectForm.warehouse)?.quantity ?? null!;
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

const handleAddProductToProject = () => {
    return new Promise<void>((resolve, reject) => {
        addToProjectForm.post(
            route("products.add-to-project"),
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

const showDeleteModal = ref<boolean>(false);

const deleteForm = useForm<DeleteForm>({
    id: null!,
    name: null!,
    created_at: null!,
});

const openDeleteModal = (item: Project) => {
    deleteForm.id = item.id;
    deleteForm.name = item.name;
    deleteForm.created_at = item.created_at as Date;

    showDeleteModal.value = true;
};

const closeDeleteModal = () => {
    showDeleteModal.value = false;
    deleteForm.reset();
};

const handleDelete = () => {
    deleteForm.delete(route("products.destroy", deleteForm.id as number), {
        preserveScroll: true,
    });
    closeDeleteModal();
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
                    class="bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <Table
                            :data-table="dataTable"
                            :per-page-options="[5, 10, 15, 20, 50]"
                            :global-search="true"
                            :type-search="true"
                            :show-trashed="true"
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

                            <template #cell(type)="{ value, item }">
                                <div class="flex gap-1.5">
                                    {{ replaceEnumUnderscores(findEnumKeyByValue(ProductType, value)) }}
                                </div>
                            </template>

                            <template #cell(quantity_varna)="{ value, item }">
                                <div
                                    class="cursor-pointer text-center rounded"
                                    :class="{
                                        'bg-red-500 text-white': (value[0]?.quantity ?? null) < item.minimum_quantity,
                                    }"
                                    @click="openChangeQuantityModal(value[0] ?? null)"
                                >
                                    {{ value[0]?.quantity ?? '' }}
                                </div>
                            </template>

                            <template #cell(quantity_france)="{ value, item }">
                                <div
                                    class="cursor-pointer text-center rounded"
                                    :class="{
                                        'bg-red-500 text-white': (value[0]?.quantity ?? null) < item.minimum_quantity,
                                    }"
                                    @click="openChangeQuantityModal(value[0] ?? null)"
                                >
                                    {{ value[0]?.quantity ?? '' }}
                                </div>
                            </template>

                            <template #cell(quantity_netherlands)="{ value, item }">
                                <div
                                    class="cursor-pointer text-center rounded"
                                    :class="{
                                        'bg-red-500 text-white': (value[0]?.quantity ?? null) < item.minimum_quantity,
                                    }"
                                    @click="openChangeQuantityModal(value[0] ?? null)"
                                >
                                    {{ value[0]?.quantity ?? '' }}
                                </div>
                            </template>

                            <template #cell(action)="{ value, item }">
                                <div class="flex gap-1.5">
                                    <Link
                                        class="border border-gray-300 dark:border-gray-700 rounded-md p-1 active:scale-90 transition"
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

                                    <button
                                        class="border border-gray-300 dark:border-gray-700 rounded-md p-1 active:scale-90 transition"
                                        :title="'Add to project'"
                                        @click="openAddToProjectModal(item)"
                                    >
                                        <Plus classes="w-4 h-4 text-[#909090]" />
                                    </button>

                                    <button
                                        class="border border-gray-300 dark:border-gray-700 rounded-md p-1 active:scale-90 transition"
                                        :title="'Show products'"
                                        @click="openShowProjectsDataTableModal(item.id)"
                                    >
                                        <IconDocument classes="w-4 h-4 text-[#909090]" />
                                    </button>

                                    <button
                                        :title="'Delete'"
                                        class="border border-gray-300 dark:border-gray-700 rounded-md p-1 active:scale-90 transition"
                                        @click="openDeleteModal(item)"
                                    >
                                        <IconTrash classes="w-4 h-4 text-[#909090]" />
                                    </button>
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

            <div class="col-span-2 flex justify-end gap-3 my-2 pt-1 px-4">
                <ResetSaveButtons
                    :processing="updateQuantityForm.processing"
                    :recently-successful="updateQuantityForm.recentlySuccessful"
                    @reset="updateQuantityForm.reset()"
                />
            </div>
        </form>
    </Modal>

    <Modal
        :show="showAddToProjectModal"
        max-width="lg"
        @close="closeAddToProjectModal"
    >
        <div
            class="border-b border-gray-100 dark:border-gray-700 px-3.5 p-3 text-xl font-medium"
        >
            <div>Add product # {{ addToProjectForm?.product_id }} to project</div>
        </div>

        <form
            class="p-6"
            @submit.prevent="handleAddProductToProject"
        >
            <div>
                <InputLabel
                    for="project"
                    :value="'Project'"
                />

                <Select
                    v-model="addToProjectForm.project_id"
                    :name="'project_id'"
                    :options="projects"
                    :placeholder="'Project'"
                    class="mt-1 block w-full mb-3.5"
                    @select="updateAvailableQuantity"
                />

                <InputError
                    class="mt-2"
                    :message="addToProjectForm.errors.project_id"
                />
            </div>

            <div>
                <InputLabel
                    for="available_quantity"
                    :value="`Available quantity in ${findEnumKeyByValue(Warehouse, addToProjectForm.warehouse) ?? 'warehouse'}`"
                />

                <TextInput
                    id="quantity"
                    :model-value="addToProjectForm.available_quantity"
                    type="number"
                    :placeholder="'Available quantity'"
                    :disabled="true"
                    class="mt-1 block w-full mb-3.5"
                />

                <InputError
                    class="mt-2"
                    :message="addToProjectForm.errors.available_quantity"
                />
            </div>

            <div>
                <InputLabel
                    for="quantity"
                    :value="`Quantity to add to ${findKeyByValue(props.projects, addToProjectForm.project_id) ?? 'project'}`"
                />

                <TextInput
                    id="quantity"
                    v-model="addToProjectForm.quantity"
                    type="number"
                    :placeholder="'Quantity to add'"
                    step="1"
                    :min="1"
                    :max="addToProjectForm.available_quantity"
                    class="mt-1 block w-full"
                />

                <InputError
                    class="mt-2"
                    :message="addToProjectForm.errors.quantity"
                />
            </div>

            <div class="col-span-2 flex justify-end gap-3 my-2 pt-1 px-4">
                <ResetSaveButtons
                    :processing="updateQuantityForm.processing"
                    :recently-successful="updateQuantityForm.recentlySuccessful"
                    @reset="updateQuantityForm.reset()"
                />
            </div>
        </form>
    </Modal>

    <Modal
        :show="showProjectsDataTableModal"
        max-width="6xl"
        @close="closeProjectsDataTableModal"
    >
        <div
            class="px-3.5 p-3 text-xl font-medium"
        >
            Projects
        </div>

        <div
            v-if="showProjectsDataTable"
            class="text-gray-900 dark:text-gray-100"
        >
            <Table
                :data-table="showProjectsDataTable"
                :per-page-options="[5, 10, 15, 20, 50]"
                :global-search="true"
                :advanced-filters="false"
                prop-name="showProjectsDataTable"
            >
                <template #cell(created_at)="{ value, item }">
                    <div class="flex gap-1.5">
                        {{ dateTimeToLocaleString(value) }}
                    </div>
                </template>

                <template #cell(project.warehouse)="{ value, item }">
                    <div class="flex gap-1.5">
                        {{ findEnumKeyByValue(Warehouse, item.project.warehouse) }}
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
    </Modal>

    <Modal
        :show="showDeleteModal"
        @close="closeDeleteModal"
    >
        <div
            class="border-b border-gray-100 dark:border-gray-700 px-3.5 p-3 text-xl font-medium"
        >
            Delete project {{ deleteForm?.name ?? '' }} added on {{ dateTimeToLocaleString(deleteForm?.created_at) }} ?
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
