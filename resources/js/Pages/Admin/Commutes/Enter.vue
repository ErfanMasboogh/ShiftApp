<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                ثبت ورود
            </h2>
        </template>
        <div class="my-5 grid grid-cols-1">
            <div class="flex mx-auto gap-3 items-center">
                <div>
                    <SelectBox
                        v-model="form.user_id"
                        :array="props.context.users"
                        name="کاربر"
                    ></SelectBox>
                </div>
            </div>
            <div class="justify-self-center my-2">
                <PrimaryButton @click="submit">ثبت ورود</PrimaryButton>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SelectBox from "@/Components/SelectBox.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    context: Object,
});

const form = useForm({
    user_id: "",
});

function submit() {
    form.post(route("admin.commutes.enter"));
}
</script>
