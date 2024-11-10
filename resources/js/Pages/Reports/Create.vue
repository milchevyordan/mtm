<script setup lang="ts">
import {Head, useForm} from "@inertiajs/vue3";

import ResetSaveButtons from "@/Components/HTML/ResetSaveButtons.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import SelectMultiple from "@/Components/SelectMultiple.vue";
import TextInput from "@/Components/TextInput.vue";
import {Multiselect} from "@/DataTable/types";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Project, ReportForm} from "@/types";

defineProps<{
    projects: Multiselect<Project>;
}>();

const form = useForm<ReportForm>({
    id: null!,
    date_from: null!,
    date_to: null!,
    projects: [],
});

const save = async (only?: Array<string>) => {
    return new Promise<void>((resolve, reject) => {
        form.post(route("reports.store"), {
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
    <Head :title="'Report'" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Report
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
                                        for="date_from"
                                        value="Date From"
                                    />

                                    <TextInput
                                        id="date_from"
                                        v-model="form.date_from"
                                        type="date"
                                        class="mt-1 block w-full"
                                        required
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.date_from"
                                    />
                                </div>

                                <div>
                                    <InputLabel
                                        for="date_to"
                                        value="Date To"
                                    />

                                    <TextInput
                                        id="date_to"
                                        v-model="form.date_to"
                                        type="date"
                                        class="mt-1 block w-full"
                                        required
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.date_to"
                                    />
                                </div>

                                <div>
                                    <InputLabel
                                        for="projects"
                                        value="Projects"
                                    />

                                    <SelectMultiple
                                        id="warehouse"
                                        v-model="form.projects as unknown as number[]"
                                        :name="'projects'"
                                        :multiple="true"
                                        :options="projects"
                                        :placeholder="'Projects'"
                                        class="mt-1 block w-full mb-3.5"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.projects"
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