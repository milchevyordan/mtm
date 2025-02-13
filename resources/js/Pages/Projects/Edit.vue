<script setup lang="ts">
import {Head, Link, router, useForm} from "@inertiajs/vue3";
import { ref } from "vue";

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
import DocumentText from "@/Icons/DocumentText.vue";
import Move from "@/Icons/Move.vue";
import IconPencilSquare from "@/Icons/PencilSquare.vue";
import IconTrash from "@/Icons/Trash.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ChangeLog, DeleteForm, ProductProject, ProductProjectForm, Project, ProjectForm, SelectInput} from "@/types";
import {dateTimeToLocaleString, findEnumKeyByValue, findKeyByValue, replaceEnumUnderscores, withFlash} from "@/utils";

const props = defineProps<{
    project: Project;
    dataTable: DataTable<ProductProject>
    changeLogs?: DataTable<ChangeLog>;
    projects?: Multiselect<Project>;
    projectWarehouse?: Record<number, number>;
}>();

const form = useForm<ProjectForm>({
    _method: "put",
    id: props.project.id,
    name: props.project.name,
    warehouse: props.project.warehouse,
});

const save = async (only?: Array<string>) => {
    return new Promise<void>((resolve, reject) => {
        form.post(route("projects.update", props.project.id as number), {
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
    deleteForm.name = item.product?.name as string;
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
    product_id: null!,
    project_id: null!,
    name: null!,
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
    moveToProjectForm.name = item.product?.name;
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
    <Head :title="'Проект'" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Проект
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
                                        value="Име"
                                    />

                                    <TextInput
                                        id="name"
                                        v-model="form.name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.name"
                                    />
                                </div>

                                <div>
                                    <InputLabel
                                        for="warehouse"
                                        value="Склад"
                                    />

                                    <Select
                                        v-model="form.warehouse"
                                        :name="'warehouse'"
                                        :options="Warehouse"
                                        :placeholder="'Склад'"
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

                            <Creator :creator-name="project.creator?.name" />
                        </div>
                    </div>
                </div>

                <div
                    class="relative rounded-lg shadow-sm bg-white dark:bg-gray-800 py-4 sm:py-6 px-4 mt-4"
                >
                    <Accordion>
                        <template #head>
                            <div class="font-semibold text-xl sm:text-2xl mb-4 text-gray-900 dark:text-gray-100">
                                Зачислени Продукти
                            </div>
                        </template>

                        <div class="text-gray-900 dark:text-gray-100">
                            <Table
                                :data-table="dataTable"
                                :per-page-options="[5, 10, 15, 20, 50]"
                                :type-search="true"
                                :global-search="true"
                                :advanced-filters="false"
                            >
                                <template #cell(created_at)="{ value, item }">
                                    <div class="flex gap-1.5">
                                        {{ dateTimeToLocaleString(value) }}
                                    </div>
                                </template>

                                <template #cell(product.type)="{ value, item }">
                                    <div class="flex gap-1.5">
                                        {{ replaceEnumUnderscores(findEnumKeyByValue(ProductType, item.product?.type)) }}
                                    </div>
                                </template>

                                <template #cell(action)="{ value, item }">
                                    <div
                                        v-if="item.product?.id"
                                        class="flex gap-1.5"
                                    >
                                        <Link
                                            class="border border-[#E9E7E7] dark:border-gray-700 rounded-md p-1 active:scale-90 transition"
                                            :title="'Редактирай продукт'"
                                            :href="route('products.edit', item.product.id)"
                                        >
                                            <IconPencilSquare
                                                classes="w-4 h-4 "
                                            />
                                        </Link>

                                        <Link
                                            class="border border-gray-300 dark:border-gray-700 rounded-md p-1 active:scale-90 transition"
                                            :title="'Покажи продукт'"
                                            :href="route('products.show', item.product.id)"
                                        >
                                            <DocumentText
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
                                            :title="'Delete продукт'"
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

                <ChangeLogs
                    :change-logs-limited="project.change_logs_limited"
                    :change-logs="changeLogs"
                />
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


            <InputLabel
                class="mt-2 p-3"
                for="comment"
                :value="'Може да се избира към кой проект да се премести, останалите неща не могат да се сменят.'"
            />

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
            Delete product {{ deleteForm?.name ?? '' }} added on {{ dateTimeToLocaleString(deleteForm?.created_at) }} ?
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
