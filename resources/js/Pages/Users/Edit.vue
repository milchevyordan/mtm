<script setup lang="ts">
import {Head, useForm} from "@inertiajs/vue3";

import ResetSaveButtons from "@/Components/HTML/ResetSaveButtons.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {User, UserForm} from "@/types";
import {withFlash} from "@/utils";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import ChangeLogs from "@/Components/HTML/ChangeLogs.vue";

const props = defineProps<{
    user: User;
}>();

const form = useForm<UserForm>({
    _method: "put",
    id: props.user.id,
    name: props.user.name,
    email: props.user.email,
});

const save = async (only?: Array<string>) => {
    return new Promise<void>((resolve, reject) => {
        form.post(route("users.update", props.user.id as number), {
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
                                    <InputLabel for="name" value="Name"/>

                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.name"
                                        required
                                        autofocus
                                        autocomplete="name"
                                    />

                                    <InputError class="mt-2" :message="form.errors.name"/>
                                </div>

                                <div>
                                    <InputLabel for="email" value="Email"/>

                                    <TextInput
                                        id="email"
                                        type="email"
                                        class="mt-1 block w-full"
                                        v-model="form.email"
                                        required
                                        autocomplete="username"
                                    />

                                    <InputError class="mt-2" :message="form.errors.email"/>
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

                <ChangeLogs :change-logs="user.change_logs"/>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
