<script setup lang="ts">
import {Head, useForm} from "@inertiajs/vue3";

import ResetSaveButtons from "@/Components/HTML/ResetSaveButtons.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { UserForm } from "@/types";

const form = useForm<UserForm>({
    id: null!,
    name: null!,
    email: null!,
});

const save = async (only?: Array<string>) => {
    return new Promise<void>((resolve, reject) => {
        form.post(route("users.store"), {
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
    <Head :title="'User'"/>

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                User
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
                                class="grid grid-cols-1 sm:grid-cols-2 xl:border-r border-[#E9E7E7] xl:pr-8 sm:gap-y-2 items-center h-fit"
                                @submit.prevent="save()"
                            >
                                <label for="name">
                                    Name
                                    <span class="text-red-500"> *</span>
                                </label>
                                <input
                                    required
                                    v-model="form.name"
                                    :name="'name'"
                                    type="text"
                                    :placeholder="'First Name'"
                                    class="border border-gray-200 text-gray-900 text-sm rounded-md focus:outline-none focus:ring-0 focus:border-gray-300 block w-full py-2 px-2.5 placeholder-gray-400 peer transition hover:bg-gray-50 focus:bg-gray-50 disabled:bg-slate-100 mb-3.5 sm:mb-0"
                                />

                                <label for="email">
                                    Email
                                    <span class="text-red-500"> *</span>
                                </label>
                                <input
                                    required
                                    v-model="form.email"
                                    :name="'email'"
                                    type="email"
                                    :placeholder="'Email'"
                                    class="border border-gray-200 text-gray-900 text-sm rounded-md focus:outline-none focus:ring-0 focus:border-gray-300 block w-full py-2 px-2.5 placeholder-gray-400 peer transition hover:bg-gray-50 focus:bg-gray-50 disabled:bg-slate-100 mb-3.5 sm:mb-0"
                                />

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
