<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                ایجاد شیفت
            </h2>
        </template>
        <div>
            <div class="grid max-w-5xl grid-cols-1 my-5 mx-auto">
                <div class="grid grid-cols-2">
                    <div class="grid justify-self-center grid-cols-1">
                        <div><InputLabel>نام شیفت</InputLabel></div>
                        <div><TextInput v-model="form.name"></TextInput></div>
                        <div>
                            <InputError
                                class="mt-2"
                                :message="form.errors.name"
                            />
                        </div>
                    </div>
                    <div class="grid justify-self-center grid-cols-1">
                        <div>
                            <InputLabel>حقوق ساعتی شیفت (هزارتومان)</InputLabel>
                        </div>
                        <div>
                            <NumberInput v-model="form.wage"></NumberInput>
                        </div>
                        <div>
                            <InputError
                                class="mt-2"
                                :message="form.errors.wage"
                            />
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2">
                    <div class="grid justify-self-center grid-cols-1">
                        <div><InputLabel>شروع شیفت</InputLabel></div>
                        <div><TimeInput v-model="form.start"></TimeInput></div>
                        <div>
                            <InputError
                                class="mt-2"
                                :message="form.errors.start"
                            />
                        </div>
                    </div>
                    <div class="grid justify-self-center grid-cols-1">
                        <div><InputLabel>پایان شیفت</InputLabel></div>
                        <div><TimeInput v-model="form.end"></TimeInput></div>
                        <div>
                            <InputError
                                class="mt-2"
                                :message="form.errors.end"
                            />
                        </div>
                    </div>
                </div>
                <div class="mx-auto">
                    <PrimaryButton
                        class="mx-auto"
                        :class="{ 'opacity-25 mx-auto': form.processing }"
                        :disabled="form.processing"
                        @click="submit"
                        >ایجاد شیفت</PrimaryButton
                    >
                </div>
            </div>
        </div>
        <div>
            <ErrorModal :show="errorModalShow" @close="errorModalF">
                {{ props.error }}
            </ErrorModal>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import ErrorModal from "@/Components/ErrorModal.vue";
import NumberInput from "@/Components/NumberInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TimeInput from "@/Components/TimeInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { onMounted, ref, watch } from "vue";

const form = useForm({
    name: "",
    wage: "",
    start: "",
    end: "",
});

const props = defineProps({
    error: {
        type: String,
        default: null,
    },
});
const errorModalValue = ref(props.error);
const errorModalShow = ref(false);
function errorModalF() {
    errorModalValue.value = null;
    errorModalShow.value = !errorModalShow.value;
}
const submit = () => {
    form.post(route("admin.shifts.new"), {
        onSuccess: () => {
            if (props.error) {
                errorModalShow.value = true;
            }
        },
    });
};
</script>
