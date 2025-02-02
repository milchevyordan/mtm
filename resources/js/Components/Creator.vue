<script setup lang="ts">
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps<{
    creatorName?: string;
}>();
</script>

<template>
    <div class="mt-6 space-y-6">
        <div v-if="creatorName">
            <InputLabel value="Създател" />

            <TextInput
                id="name"
                :model-value="creatorName"
                type="text"
                disabled
                class="mt-1 block w-full"
            />
        </div>
    </div>
</template>
